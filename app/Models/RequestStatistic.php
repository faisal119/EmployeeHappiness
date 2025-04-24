<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;

class RequestStatistic extends Model
{
    protected $table = 'request_statistics';
    
    protected $fillable = [
        'admin_id',
        'request_id',
        'request_type',
        'action_type',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'admin_id' => 'integer',
        'request_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::info('📌 بداية إنشاء سجل إحصائيات جديد:', [
                'admin_id' => $model->admin_id,
                'request_id' => $model->request_id,
                'request_type' => $model->request_type,
                'action_type' => $model->action_type,
                'created_at' => $model->created_at,
                'table_exists' => Schema::hasTable('request_statistics'),
                'columns' => Schema::getColumnListing('request_statistics')
            ]);

            // التحقق من وجود البيانات المطلوبة
            if (!$model->admin_id || !$model->request_id || !$model->request_type || !$model->action_type) {
                $error = 'بيانات غير مكتملة عند محاولة إنشاء سجل إحصائيات';
                Log::error('❌ ' . $error, [
                    'admin_id' => $model->admin_id,
                    'request_id' => $model->request_id,
                    'request_type' => $model->request_type,
                    'action_type' => $model->action_type,
                    'admin_exists' => \App\Models\Admin::find($model->admin_id) ? true : false
                ]);
                throw new \Exception($error);
            }

            // التحقق من وجود المشرف
            $admin = \App\Models\Admin::find($model->admin_id);
            if (!$admin) {
                $error = "المشرف غير موجود: {$model->admin_id}";
                Log::error('❌ ' . $error);
                throw new \Exception($error);
            }

            Log::info('✅ التحقق من البيانات تم بنجاح', [
                'admin_id' => $model->admin_id,
                'request_id' => $model->request_id,
                'request_type' => $model->request_type,
                'action_type' => $model->action_type
            ]);

            return true;
        });

        static::created(function ($model) {
            Log::info('✅ تم إنشاء سجل إحصائيات جديد:', [
                'id' => $model->id,
                'admin_id' => $model->admin_id,
                'request_id' => $model->request_id,
                'request_type' => $model->request_type,
                'action_type' => $model->action_type,
                'created_at' => $model->created_at
            ]);
        });
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function residencyRequest()
    {
        return $this->belongsTo(ResidencyRequest::class, 'request_id');
    }

    public function insuranceRequest()
    {
        return $this->belongsTo(InsuranceRequest::class, 'request_id');
    }

    public function discountCardRequest()
    {
        return $this->belongsTo(DiscountCardRequest::class, 'request_id');
    }

    public static function createStatistic($data)
    {
        try {
            Log::debug('🔍 البيانات المستلمة في createStatistic:', $data);

            // التحقق من وجود الجدول وأعمدته
            if (!Schema::hasTable('request_statistics')) {
                throw new \Exception("⚠️ جدول request_statistics غير موجود في قاعدة البيانات");
            }

            $requiredColumns = ['id', 'admin_id', 'request_id', 'request_type', 'action_type', 'created_at', 'updated_at'];
            $existingColumns = Schema::getColumnListing('request_statistics');
            $missingColumns = array_diff($requiredColumns, $existingColumns);
            
            if (!empty($missingColumns)) {
                throw new \Exception("⚠️ الأعمدة التالية مفقودة في الجدول: " . implode(', ', $missingColumns));
            }

            Log::info('✅ تم التحقق من وجود الجدول وأعمدته بنجاح');

            DB::beginTransaction();

            // التحقق من تسجيل دخول المشرف
            $admin_id = $data['admin_id'] ?? auth('admin')->id();
            if (!$admin_id) {
                throw new \Exception("⚠️ لم يتم العثور على معرف المشرف في الجلسة");
            }

            // التحقق من وجود المشرف في قاعدة البيانات
            $admin = \App\Models\Admin::find($admin_id);
            if (!$admin) {
                throw new \Exception("⚠️ المشرف غير موجود في قاعدة البيانات: {$admin_id}");
            }

            Log::info('✅ تم التحقق من وجود المشرف:', [
                'admin_id' => $admin_id,
                'admin_name' => $admin->name
            ]);

            // التحقق من وجود البيانات المطلوبة
            $requiredFields = ['request_id', 'request_type', 'action_type'];
            $missingFields = [];
            foreach ($requiredFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    $missingFields[] = $field;
                }
            }
            
            if (!empty($missingFields)) {
                throw new \Exception("⚠️ الحقول التالية مطلوبة ولكنها فارغة: " . implode(', ', $missingFields));
            }

            Log::info('✅ تم التحقق من اكتمال البيانات المطلوبة');

            // تحضير البيانات للإنشاء
            $statistic = new static();
            $statistic->admin_id = $admin_id;
            $statistic->request_id = $data['request_id'];
            $statistic->request_type = $data['request_type'];
            $statistic->action_type = $data['action_type'];
            $statistic->created_at = now();
            $statistic->updated_at = now();

            // محاولة الحفظ
            try {
                $saved = $statistic->save();
                if (!$saved) {
                    throw new \Exception("⚠️ فشل حفظ سجل الإحصائية لسبب غير معروف");
                }
            } catch (\Exception $e) {
                Log::error('❌ خطأ أثناء محاولة الحفظ:', [
                    'error' => $e->getMessage(),
                    'data' => $statistic->toArray()
                ]);
                throw $e;
            }

            Log::info('🟢 تم حفظ الإحصائية بنجاح:', [
                'id' => $statistic->id,
                'admin_id' => $statistic->admin_id,
                'request_id' => $statistic->request_id,
                'request_type' => $statistic->request_type,
                'action_type' => $statistic->action_type,
                'created_at' => $statistic->created_at
            ]);

            DB::commit();
            return $statistic;

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('❌ خطأ في قاعدة البيانات:', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'code' => $e->getCode(),
                'data' => $data
            ]);
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ خطأ عام:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data
            ]);
            throw $e;
        }
    }
} 