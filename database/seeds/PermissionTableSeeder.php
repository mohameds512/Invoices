<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'الفواتير',
            'قائمة الفواتير',
            'الفواتير المدفوعه',
            'الفواتير المدفوعه جزئيا',
            'الفواتير الغير مدفوعه',
            'ارشيف الفواتير',
            'أضافة فاتورة',
            'حذف فاتورة',
            'تصدير Excel',
            'تغيير حالة الدفع',
            'تعديل الفاتورة',
            'أضافة مرفق',
            'حذف مرفق',

            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'أضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'أضافة صلاحية',
            'تعديل صاحية',
            'حذف صلاحية',


            'التقارير',
            'تقرير الفواتير',
            'تقرير العملاء',



            'الاعدادات',

            'المنتجات',
            'أضافة منتج',
            'تعديل منتج',
            'حذف منتج',

            'الاقسام',
            'أضافة قسم',
            'تعديل قسم',
            'حذف قسم',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
