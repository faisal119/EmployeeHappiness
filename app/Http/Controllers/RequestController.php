<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceRequest;
use App\Models\ResidencyRequest;
use App\Models\DiscountCardRequest;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    public function storeInsuranceRequest(Request $request)
    {
        try {
            Log::info('🟢 بداية استلام طلب التأمين:', [
                'all_data' => $request->all(),
                'files' => $request->allFiles(),
                'method' => $request->method(),
                'url' => $request->url(),
                'service_type' => $request->service_type
            ]);

            // التحقق من نوع الطلب
            switch ($request->service_type) {
                case 'add-spouse':
                    $validated = $request->validate([
                        'military_id' => 'required|string|max:255',
                        'spouse_name' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                        'phone' => 'required|string|max:20',
                        'unified_number' => 'nullable|string|max:255',
                        'marriage_contract' => 'required|file|mimes:pdf|max:2048',
                        'passport' => 'required|file|mimes:pdf|max:2048',
                        'id_card' => 'required|file|mimes:pdf|max:2048',
                        'photo' => 'required|image|max:2048',
                        'description' => 'nullable|string',
                    ], [
                        'military_id.required' => 'الرجاء إدخال الرقم العسكري',
                        'spouse_name.required' => 'الرجاء إدخال اسم الزوج/الزوجة',
                        'email.required' => 'الرجاء إدخال البريد الإلكتروني',
                        'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
                        'phone.required' => 'الرجاء إدخال رقم الهاتف',
                        'marriage_contract.required' => 'الرجاء إرفاق عقد الزواج',
                        'marriage_contract.mimes' => 'يجب أن يكون عقد الزواج بصيغة PDF',
                        'passport.required' => 'الرجاء إرفاق جواز السفر',
                        'passport.mimes' => 'يجب أن يكون جواز السفر بصيغة PDF',
                        'id_card.required' => 'الرجاء إرفاق الهوية الإماراتية',
                        'id_card.mimes' => 'يجب أن تكون الهوية الإماراتية بصيغة PDF',
                        'photo.required' => 'الرجاء إرفاق الصورة الشخصية',
                        'photo.image' => 'يجب أن تكون الصورة الشخصية بصيغة صورة صالحة'
                    ]);
                    break;

                case 'add-children':
                    $validated = $request->validate([
                        'military_id' => 'required|string|max:255',
                        'child_name' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                        'phone' => 'required|string|max:20',
                        'unified_number' => 'nullable|string|max:255',
                        'birth_certificate' => 'required|file|mimes:pdf|max:2048',
                        'passport' => 'required|file|mimes:pdf|max:2048',
                        'id_card' => 'required|file|mimes:pdf|max:2048',
                        'photo' => 'required|image|max:2048',
                        'description' => 'nullable|string',
                    ], [
                        'military_id.required' => 'الرجاء إدخال الرقم العسكري',
                        'child_name.required' => 'الرجاء إدخال اسم الابن/البنت',
                        'email.required' => 'الرجاء إدخال البريد الإلكتروني',
                        'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
                        'phone.required' => 'الرجاء إدخال رقم الهاتف',
                        'birth_certificate.required' => 'الرجاء إرفاق شهادة الميلاد',
                        'birth_certificate.mimes' => 'يجب أن تكون شهادة الميلاد بصيغة PDF',
                        'passport.required' => 'الرجاء إرفاق جواز السفر',
                        'passport.mimes' => 'يجب أن يكون جواز السفر بصيغة PDF',
                        'id_card.required' => 'الرجاء إرفاق الهوية الإماراتية',
                        'id_card.mimes' => 'يجب أن تكون الهوية الإماراتية بصيغة PDF',
                        'photo.required' => 'الرجاء إرفاق الصورة الشخصية',
                        'photo.image' => 'يجب أن تكون الصورة الشخصية بصيغة صورة صالحة'
                    ]);
                    break;

                case 'add-parents':
                    $validated = $request->validate([
                        'military_id' => 'required|string|max:255',
                        'parent_name' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                        'phone' => 'required|string|max:20',
                        'marital_status' => 'required|string|in:married,divorced,widowed',
                        'passport' => 'required|file|mimes:pdf|max:2048',
                        'id_card' => 'required|file|mimes:pdf|max:2048',
                        'photo' => 'required|image|max:2048',
                        'relation_type' => 'required|string|in:father,mother',
                        'family_book' => 'required|file|mimes:pdf|max:2048',
                        'description' => 'nullable|string',
                    ], [
                        'military_id.required' => 'الرجاء إدخال الرقم العسكري',
                        'parent_name.required' => 'الرجاء إدخال اسم الوالد/الوالدة',
                        'email.required' => 'الرجاء إدخال البريد الإلكتروني',
                        'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
                        'phone.required' => 'الرجاء إدخال رقم الهاتف',
                        'marital_status.required' => 'الرجاء اختيار الحالة الاجتماعية',
                        'marital_status.in' => 'الرجاء اختيار حالة اجتماعية صحيحة',
                        'passport.required' => 'الرجاء إرفاق جواز السفر',
                        'passport.mimes' => 'يجب أن يكون جواز السفر بصيغة PDF',
                        'id_card.required' => 'الرجاء إرفاق الهوية الإماراتية',
                        'id_card.mimes' => 'يجب أن تكون الهوية الإماراتية بصيغة PDF',
                        'photo.required' => 'الرجاء إرفاق الصورة الشخصية',
                        'photo.image' => 'يجب أن تكون الصورة الشخصية بصيغة صورة صالحة',
                        'relation_type.required' => 'الرجاء اختيار نوع القرابة',
                        'relation_type.in' => 'نوع القرابة يجب أن يكون إما الأب أو الأم',
                        'family_book.required' => 'الرجاء إرفاق خلاصة القيد',
                        'family_book.mimes' => 'يجب أن تكون خلاصة القيد بصيغة PDF'
                    ]);
                    break;

                case 'certificate':
                    $validated = $request->validate([
                        'military_id' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                        'phone' => 'required|string|max:20',
                        'unified_number' => 'nullable|string|max:255',
                        'description' => 'required|string',
                    ], [
                        'military_id.required' => 'الرجاء إدخال الرقم العسكري',
                        'email.required' => 'الرجاء إدخال البريد الإلكتروني',
                        'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
                        'phone.required' => 'الرجاء إدخال رقم الهاتف',
                        'description.required' => 'الرجاء إدخال سبب طلب الشهادة'
                    ]);
                    break;

                default:
                    $validated = $request->validate([
                        'military_id' => 'required|string|max:255',
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|max:255',
                        'phone' => 'required|string|max:20',
                        'service_type' => 'required|string|in:new,update,update-info',
                        'unified_number' => 'nullable|string|max:255',
                        'residency' => 'nullable|file|mimes:pdf|max:2048',
                        'hiring_date' => 'nullable|date',
                        'marital_status' => 'required|string|in:single,married,divorced,widowed',
                        'passport' => $request->service_type === 'update' ? 'nullable|file|mimes:pdf|max:2048' : 'required|file|mimes:pdf|max:2048',
                        'id_card' => $request->service_type === 'update' ? 'nullable|file|mimes:pdf|max:2048' : 'required|file|mimes:pdf|max:2048',
                        'photo' => $request->service_type === 'update' ? 'nullable|image|max:2048' : 'required|image|max:2048',
                        'update_reason' => $request->service_type === 'update' ? 'required|string' : 'nullable|string',
                        'description' => 'nullable|string',
                    ], [
                        'military_id.required' => 'الرجاء إدخال الرقم العسكري',
                        'name.required' => 'الرجاء إدخال الاسم الكامل',
                        'email.required' => 'الرجاء إدخال البريد الإلكتروني',
                        'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
                        'phone.required' => 'الرجاء إدخال رقم الهاتف',
                        'marital_status.required' => 'الرجاء اختيار الحالة الاجتماعية',
                        'marital_status.in' => 'الرجاء اختيار حالة اجتماعية صحيحة',
                        'update_reason.required' => 'الرجاء إدخال سبب التحديث',
                        'passport.required' => 'الرجاء إرفاق جواز السفر',
                        'passport.mimes' => 'يجب أن يكون جواز السفر بصيغة PDF',
                        'id_card.required' => 'الرجاء إرفاق الهوية الإماراتية',
                        'id_card.mimes' => 'يجب أن تكون الهوية الإماراتية بصيغة PDF',
                        'photo.required' => 'الرجاء إرفاق الصورة الشخصية',
                        'photo.image' => 'يجب أن تكون الصورة الشخصية بصيغة صورة صالحة',
                        'residency.mimes' => 'يجب أن تكون الإقامة بصيغة PDF',
                        'hiring_date.date' => 'يجب أن يكون تاريخ التعيين تاريخاً صحيحاً'
                    ]);
            }

            // معالجة الملفات المرفقة
            $files = [];

            // تحديد الملفات المطلوبة حسب نوع الطلب
            switch ($request->service_type) {
                case 'add-spouse':
                    $files = ['passport', 'id_card', 'photo', 'marriage_contract'];
                    break;
                case 'add-children':
                    $files = ['passport', 'id_card', 'photo', 'birth_certificate'];
                    break;
                case 'add-parents':
                    $files = ['passport', 'id_card', 'photo', 'family_book'];
                    break;
                case 'certificate':
                    // لا يتطلب ملفات
                    break;
                case 'update':
                    // الملفات اختيارية في حالة التحديث
                    $files = array_filter(['passport', 'id_card', 'photo'], function($file) use ($request) {
                        return $request->hasFile($file);
                    });
                    break;
                default:
                    $files = ['passport', 'id_card', 'photo'];
            }

            $filePaths = [];
            foreach ($files as $file) {
                if ($request->hasFile($file)) {
                    Log::info('📁 معالجة الملف:', ['file' => $file]);
                    $filePaths[$file] = $request->file($file)->store('insurance_files', 'public');
                    Log::info('✅ تم حفظ الملف:', ['file' => $file, 'path' => $filePaths[$file]]);
                } else {
                    // تجاهل الملفات في حالة طلب الشهادة
                    if ($request->service_type === 'certificate') {
                        continue;
                    }
                    Log::error('❌ الملف غير موجود:', ['file' => $file]);
                    throw new \Exception('الملف المطلوب غير موجود: ' . $file);
                }
            }

            // تحضير البيانات للحفظ
            $data = [
                'name' => $request->service_type === 'add-spouse' ? $request->spouse_name : 
                         ($request->service_type === 'add-children' ? $request->child_name :
                         ($request->service_type === 'add-parents' ? $request->parent_name : 
                         ($request->service_type === 'update-info' ? $request->name : $request->name))),
                'email' => $request->email,
                'military_id' => $request->military_id,
                'unified_number' => $request->unified_number,
                'phone' => $request->phone,
                'service_type' => $request->service_type,
                'description' => $request->description,
                'status' => 'pending'
            ];

            // إضافة مسارات الملفات
            foreach ($filePaths as $key => $path) {
                $data[$key] = $path;
            }

            // إضافة الحالة الاجتماعية إذا كانت موجودة
            if ($request->has('marital_status')) {
                $data['marital_status'] = $request->marital_status;
            }

            // إضافة نوع القرابة إذا كان الطلب لإضافة الوالدين
            if ($request->service_type === 'add-parents' && $request->has('relation_type')) {
                $data['relation_type'] = $request->relation_type;
            }

            // إضافة تاريخ التعيين إذا كان موجوداً
            if ($request->has('hiring_date')) {
                $data['hiring_date'] = $request->hiring_date;
            }

            // معالجة الملفات الاختيارية
            if ($request->hasFile('residency')) {
                $data['residency'] = $request->file('residency')->store('insurance_files', 'public');
            }

            Log::info('🟢 البيانات قبل الإدخال في القاعدة:', $data);

            $insuranceRequest = InsuranceRequest::create($data);

            Log::info('✅ تم حفظ الطلب بنجاح:', ['id' => $insuranceRequest->id]);

            return redirect()->back()->with('success', 'تم إرسال الطلب بنجاح!');

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في حفظ الطلب:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إرسال الطلب: ' . $e->getMessage());
        }
    }

    public function updateInsuranceRequest(Request $request)
    {
        try {
            Log::info('🟢 بداية استلام طلب تحديث التأمين:', [
                'all_data' => $request->all(),
                'files' => $request->allFiles(),
                'method' => $request->method(),
                'url' => $request->url(),
                'update_for' => $request->update_for,
                'update_items' => $request->update_items
            ]);

            // التحقق من البيانات
            $validated = $request->validate([
                'military_id' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'update_for' => 'required|string|in:self,spouse,children,parents',
                'update_reason' => 'required|string',
                'update_items' => 'required|array',
                'update_items.*' => 'required|string|in:passport,id_card,photo,marriage_contract,residency,family_book'
            ]);

            // تحضير البيانات للحفظ
            $data = [
                'military_id' => $request->military_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'service_type' => 'update',
                'update_reason' => $request->update_reason,
                'status' => 'pending'
            ];

            // إضافة البيانات حسب نوع التحديث
            switch ($request->update_for) {
                case 'spouse':
                    $data['name'] = $request->spouse_name;
                    break;
                case 'children':
                    $data['child_name'] = $request->child_name;
                    break;
                case 'parents':
                    $data['name'] = $request->parent_name;
                    $data['relation_type'] = $request->relation_type;
                    break;
                default:
                    $data['name'] = $request->military_id;
                    break;
            }
            
            // معالجة المرفقات المحددة فقط
            foreach ($request->update_items as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    
                    // التحقق من نوع الملف
                    if ($field === 'photo') {
                        if (!in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                            throw new \Exception('يجب أن تكون الصورة الشخصية بصيغة jpg أو jpeg أو png');
                        }
                    } else {
                        if ($file->getClientOriginalExtension() !== 'pdf') {
                            throw new \Exception('يجب أن يكون الملف ' . $field . ' بصيغة PDF');
                        }
                    }

                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $field . '_' . $request->military_id . '.' . $extension;
                    
                    // تحديد المجلد حسب نوع الملف
                    $folder = $field === 'photo' ? 'photos' : 'documents';
                    $path = 'insurance_files/' . $folder;
                    
                    // التأكد من وجود المجلد
                    if (!file_exists(public_path('storage/' . $path))) {
                        mkdir(public_path('storage/' . $path), 0777, true);
                    }
                    
                    // حفظ الملف
                    $file->move(public_path('storage/' . $path), $filename);
                    
                    // تخزين المسار في قاعدة البيانات
                    $data[$field] = $path . '/' . $filename;
                    
                    Log::info("📁 تم حفظ الملف: {$field}", [
                        'original_name' => $file->getClientOriginalName(),
                        'saved_as' => $filename,
                        'path' => $data[$field]
                    ]);
                } else {
                    throw new \Exception('الملف ' . $field . ' مطلوب');
                }
            }

            Log::info('🟢 البيانات قبل الإدخال في القاعدة:', $data);

            // إنشاء الطلب باستخدام البيانات المجهزة
            $insuranceRequest = InsuranceRequest::create($data);

            Log::info('✅ تم حفظ طلب تحديث التأمين بنجاح:', [
                'request_id' => $insuranceRequest->id,
                'files_saved' => array_filter($data, function($key) {
                    return in_array($key, ['passport', 'id_card', 'photo', 'marriage_contract', 'residency', 'family_book']);
                }, ARRAY_FILTER_USE_KEY)
            ]);

            return redirect()->back()->with('success', 'تم استلام طلب تحديث التأمين بنجاح');

        } catch (\Exception $e) {
            Log::error('❌ خطأ في معالجة طلب تحديث التأمين:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء معالجة الطلب: ' . $e->getMessage()]);
        }
    }

    public function storeResidencyRequest(Request $request)
    {
        Log::info('🟢 بداية استلام طلب الإقامة:', [
            'all_data' => $request->all(),
            'files' => $request->allFiles(),
            'method' => $request->method(),
            'url' => $request->url(),
            'headers' => $request->headers->all(),
            'route' => $request->route()->getName()
        ]);

        try {
            // التحقق من وجود الملف
            if ($request->hasFile('acquaintance_document')) {
                Log::info('✅ تم استلام ملف وثيقة التعارف', [
                    'original_name' => $request->file('acquaintance_document')->getClientOriginalName(),
                    'mime_type' => $request->file('acquaintance_document')->getMimeType(),
                    'size' => $request->file('acquaintance_document')->getSize()
                ]);
            } else {
                Log::warning('⚠️ لم يتم العثور على ملف وثيقة التعارف في الطلب');
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'military_id' => 'required|string|max:255',
                'unified_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:2',
                'passport' => 'required|file|mimes:pdf|max:10240',
                'photo' => 'required|file|mimes:jpeg,jpg,png|max:5120',
                'employment_certificate' => 'required|file|mimes:pdf|max:10240',
                'service_type' => 'required|string|in:new-residency,renew-residency,visa-request,sponsorship-transfer,residence-id',
                // الحقول الإضافية حسب نوع الخدمة
                'medical_result' => $request->service_type !== 'visa-request' ? 'required|file|mimes:pdf|max:10240' : 'nullable',
                'id_card' => $request->service_type === 'residence-id' ? 'nullable' : ($request->service_type !== 'visa-request' ? 'required|file|mimes:pdf|max:10240' : 'nullable'),
                'current_residency' => $request->service_type !== 'visa-request' && $request->service_type !== 'residence-id' ? 'required|file|mimes:pdf|max:10240' : 'nullable',
                'pakistani_id' => 'required_if:nationality,PK|file|mimes:pdf|max:10240',
                'sponsorship_transfer_certificate' => $request->service_type === 'sponsorship-transfer' ? 'required|file|mimes:pdf|max:10240' : 'nullable',
                'acquaintance_document' => 'required|file|mimes:pdf|max:10240',
            ]);

            Log::info('✅ تم التحقق من صحة البيانات:', $validatedData);

            // معالجة الملفات المرفقة
            $files = [
                'passport',
                'medical_result',
                'id_card',
                'current_residency',
                'photo',
                'pakistani_id',
                'employment_certificate',
                'sponsorship_transfer_certificate',
                'acquaintance_document'
            ];

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'military_id' => $request->military_id,
                'unified_number' => $request->unified_number,
                'nationality' => $request->nationality,
                'service_type' => $request->service_type,
                'status' => 'pending'
            ];

            foreach ($files as $file) {
                if ($request->hasFile($file)) {
                    try {
                        Log::info('📁 بدء معالجة الملف:', ['file' => $file]);
                        $path = $request->file($file)->store('residency_files', 'public');
                        $data[$file] = $path;
                        Log::info('✅ تم حفظ الملف بنجاح:', [
                            'file' => $file,
                            'path' => $path,
                            'original_name' => $request->file($file)->getClientOriginalName(),
                            'size' => $request->file($file)->getSize()
                        ]);
                    } catch (\Exception $e) {
                        Log::error('❌ خطأ في حفظ الملف:', [
                            'file' => $file,
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        throw $e;
                    }
                }
            }

            Log::info('📝 محاولة إنشاء طلب جديد مع البيانات:', $data);

            // إنشاء الطلب
            $residencyRequest = ResidencyRequest::create($data);

            Log::info('✅ تم إنشاء الطلب بنجاح:', [
                'request_id' => $residencyRequest->id,
                'saved_data' => $residencyRequest->toArray()
            ]);

            return redirect()->back()->with('success', 'تم تقديم الطلب بنجاح');

        } catch (\Exception $e) {
            Log::error('❌ خطأ في معالجة الطلب:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء معالجة الطلب: ' . $e->getMessage()]);
        }
    }

    public function storeDiscountCardRequest(Request $request)
    {
        try {
            Log::info('🟢 Raw Request Data:', [
                'all' => $request->all(),
                'post' => $_POST,
                'files' => $_FILES,
                'headers' => getallheaders()
            ]);

            Log::info('🟢 بداية استلام طلب بطاقة الخصم:', [
                'all_data' => $request->all(),
                'files' => $request->allFiles(),
                'method' => $request->method(),
                'url' => $request->url(),
                'headers' => $request->headers->all()
            ]);

            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'employee_id' => 'required|string|max:255',
                'age' => 'required|integer|min:1|max:120',
                'card_type' => 'required|string|in:إسعاد,وفر,فزعة',
                'email' => 'required|email|max:255',
                'emirate' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'father_alive' => 'required|string|in:نعم,لا',
                'mother_alive' => 'required|string|in:نعم,لا',
                'previous_card' => 'required|string|in:نعم,لا',
                'married' => 'required|string|in:نعم,لا',
                'children_count' => 'required_if:married,نعم|nullable|integer|min:0',
                'passport_copy' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'emirates_id' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            ]);

            Log::info('✅ تم التحقق من صحة البيانات:', $validated);

            // حفظ الملفات
            $passportPath = null;
            $emiratesIdPath = null;

            if ($request->hasFile('passport_copy')) {
                $passportPath = $request->file('passport_copy')->store('discount_card_files', 'public');
                Log::info('✅ تم حفظ ملف جواز السفر:', ['path' => $passportPath]);
            } else {
                Log::error('❌ لم يتم العثور على ملف جواز السفر');
            }

            if ($request->hasFile('emirates_id')) {
                $emiratesIdPath = $request->file('emirates_id')->store('discount_card_files', 'public');
                Log::info('✅ تم حفظ ملف الهوية:', ['path' => $emiratesIdPath]);
            } else {
                Log::error('❌ لم يتم العثور على ملف الهوية');
            }

            Log::info('🟢 البيانات قبل الإدخال في القاعدة:', [
                'full_name' => $request->full_name,
                'employee_id' => $request->employee_id,
                'age' => $request->age,
                'card_type' => $request->card_type,
                'email' => $request->email,
                'emirate' => $request->emirate,
                'area' => $request->area,
                'father_alive' => $request->father_alive,
                'mother_alive' => $request->mother_alive,
                'previous_card' => $request->previous_card,
                'married' => $request->married,
                'children_count' => $request->children_count,
                'passport_copy' => $passportPath,
                'emirates_id' => $emiratesIdPath,
            ]);

            $discountCardRequest = DiscountCardRequest::create([
                'full_name' => $request->full_name,
                'employee_id' => $request->employee_id,
                'age' => $request->age,
                'card_type' => $request->card_type,
                'email' => $request->email,
                'emirate' => $request->emirate,
                'area' => $request->area,
                'father_alive' => $request->father_alive,
                'mother_alive' => $request->mother_alive,
                'previous_card' => $request->previous_card,
                'married' => $request->married,
                'children_count' => $request->children_count,
                'passport_copy' => $passportPath,
                'emirates_id' => $emiratesIdPath,
                'status' => 'pending'
            ]);

            Log::info('✅ تم حفظ الطلب بنجاح:', ['id' => $discountCardRequest->id]);

            return redirect()->back()->with('success', 'تم إرسال طلب بطاقة الخصم بنجاح!');

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في حفظ طلب بطاقة الخصم:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'files' => $request->allFiles()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إرسال الطلب: ' . $e->getMessage());
        }
    }

    // ✅ عرض جميع الطلبات في صفحة الإدارة بترتيب الأحدث أولًا وتصنيفها حسب الخدمة
    public function index(Request $request)
    {
        Log::info('🟢 بداية تنفيذ دالة index');
        
        $category = $request->query('category', 'insurance'); // افتراضياً 'insurance' إذا لم يتم تحديد الفئة
        Log::info('🟢 الفئة المطلوبة:', ['category' => $category]);
        
        if ($category === 'discount-card') {
            // جلب طلبات بطاقات الخصم
            $requests = DiscountCardRequest::orderBy('created_at', 'desc')->get();
            Log::info('🟢 تم جلب طلبات بطاقات الخصم:', [
                'عدد الطلبات' => $requests->count(),
                'الطلبات' => $requests->toArray()
            ]);
        } elseif ($category === 'residency') {
            // جلب طلبات الإقامة
            $requests = ResidencyRequest::orderBy('created_at', 'desc')->get();
            Log::info('🟢 تم جلب طلبات الإقامة:', [
                'عدد الطلبات' => $requests->count(),
                'الطلبات' => $requests->toArray()
            ]);
        } else {
            // جلب طلبات التأمين
            $requests = InsuranceRequest::whereNotIn('service_type', ['residency'])
                ->orderBy('created_at', 'desc')
                ->get();
            Log::info('🟢 تم جلب طلبات التأمين:', [
                'عدد الطلبات' => $requests->count(),
                'الطلبات' => $requests->toArray()
            ]);
        }

        // عرض الصفحة
        Log::info('🟢 عرض صفحة الطلبات');
        return view('admin.requests', compact('requests', 'category'));
    }

    // ✅ عرض تفاصيل طلب معين
    public function show($id)
    {
        Log::info('🟢 محاولة عرض تفاصيل الطلب:', ['id' => $id]);
        
        // الحصول على نوع الطلب من الرابط
        $category = request()->query('category');
        Log::info('نوع الطلب المطلوب:', ['category' => $category]);

        // البحث في الجدول المناسب بناءً على نوع الطلب
        switch($category) {
            case 'insurance':
                $request = InsuranceRequest::find($id);
                $requestType = 'insurance';
                break;
            case 'residency':
                $request = ResidencyRequest::find($id);
                $requestType = 'residency';
                break;
            case 'discount-card':
                $request = DiscountCardRequest::find($id);
                $requestType = 'discount-card';
                break;
            default:
                Log::error('❌ نوع الطلب غير معروف:', ['category' => $category]);
                abort(404, 'نوع الطلب غير معروف');
        }

        if (!$request) {
            Log::error('❌ لم يتم العثور على الطلب:', ['id' => $id, 'category' => $category]);
            abort(404, 'الطلب غير موجود');
        }

        Log::info('✅ تم العثور على الطلب:', [
            'id' => $request->id,
            'type' => $requestType
        ]);

        return view('admin.request-details', [
            'request' => $request,
            'requestType' => $requestType
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            Log::info('🟢 بداية تحديث حالة الطلب:', [
                'request_id' => $id,
                'data' => $request->all()
            ]);

            $validated = $request->validate([
                'status' => 'required|in:pending,approved,rejected',
                'notes' => 'nullable|string'
            ]);

            // محاولة العثور على الطلب في جداول مختلفة
            $model = null;
            $category = $request->input('category');

            switch ($category) {
                case 'insurance':
                    $model = InsuranceRequest::findOrFail($id);
                    break;
                case 'residency':
                    $model = ResidencyRequest::findOrFail($id);
                    break;
                case 'discount-card':
                    $model = DiscountCardRequest::findOrFail($id);
                    break;
                default:
                    throw new \Exception('نوع الطلب غير صحيح');
            }
            
            Log::info('🟢 تم العثور على الطلب:', [
                'model' => get_class($model),
                'id' => $model->id,
                'old_status' => $model->status
            ]);

            $model->status = $validated['status'];
            $model->notes = $validated['notes'];
            $model->save();

            Log::info('✅ تم تحديث حالة الطلب:', [
                'request_id' => $id,
                'new_status' => $model->status,
                'notes' => $model->notes
            ]);

            return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
        } catch (\Exception $e) {
            Log::error('🔴 خطأ في تحديث حالة الطلب:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث حالة الطلب: ' . $e->getMessage());
        }
    }

    public function showFile($filename)
    {
        // تحديد المجلدات المحتملة للملف
        $possiblePaths = [
            public_path('storage/insurance_files/documents/' . $filename),
            public_path('storage/insurance_files/photos/' . $filename),
            public_path('storage/insurance_files/' . $filename),
            public_path('storage/discount_card_files/' . $filename),
            public_path('storage/residency_files/' . $filename)
        ];

        // البحث عن الملف في المجلدات المحتملة
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return response()->file($path);
            }
        }

        Log::error('❌ الملف غير موجود:', [
            'filename' => $filename,
            'searched_paths' => $possiblePaths
        ]);

        abort(404, 'الملف غير موجود');
    }
}
