<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'dashboard','guard_name' => 'admin', 'group_name' => 'dashboard']);
        Permission::create(['name' => 'theme-setting','guard_name' => 'admin', 'group_name' => 'theme_management']);

        Permission::create(['name' => 'mega-menus','guard_name' => 'admin', 'group_name' => 'website_menu_builder_management']);
        Permission::create(['name' => 'main-menus','guard_name' => 'admin', 'group_name' => 'website_menu_builder_management']);
        Permission::create(['name' => 'permalinks','guard_name' => 'admin', 'group_name' => 'website_menu_builder_management']);

        Permission::create(['name' => 'hero-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'features','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'intro-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'service-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'approach-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'statistics-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'call-to-action-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'portfolio-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'testimonials-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'team-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'blog-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'partners-section','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'sections-customization','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);
        Permission::create(['name' => 'portfolios','guard_name' => 'admin', 'group_name' => 'home_page_section_management']);

        Permission::create(['name' => 'logo-text','guard_name' => 'admin', 'group_name' => 'footer_management']);
        Permission::create(['name' => 'useful-links','guard_name' => 'admin', 'group_name' => 'footer_management']);

        Permission::create(['name' => 'settings-services','guard_name' => 'admin', 'group_name' => 'services_management']);
        Permission::create(['name' => 'category-services','guard_name' => 'admin', 'group_name' => 'services_management']);
        Permission::create(['name' => 'services','guard_name' => 'admin', 'group_name' => 'services_management']);

        Permission::create(['name' => 'category-blog','guard_name' => 'admin', 'group_name' => 'blog_management']);
        Permission::create(['name' => 'blogs','guard_name' => 'admin', 'group_name' => 'blog_management']);
        Permission::create(['name' => 'archives','guard_name' => 'admin', 'group_name' => 'blog_management']);

        Permission::create(['name' => 'settings-gallery','guard_name' => 'admin', 'group_name' => 'gallery_management']);
        Permission::create(['name' => 'categories-gallery','guard_name' => 'admin', 'group_name' => 'gallery_management']);
        Permission::create(['name' => 'galleries','guard_name' => 'admin', 'group_name' => 'gallery_management']);

        Permission::create(['name' => 'settings-faq','guard_name' => 'admin', 'group_name' => 'faq_management']);
        Permission::create(['name' => 'categories-faq','guard_name' => 'admin', 'group_name' => 'faq_management']);
        Permission::create(['name' => 'faqs','guard_name' => 'admin', 'group_name' => 'faq_management']);

        Permission::create(['name' => 'categories-career','guard_name' => 'admin', 'group_name' => 'career_management']);
        Permission::create(['name' => 'post-job','guard_name' => 'admin', 'group_name' => 'career_management']);
        Permission::create(['name' => 'job-management','guard_name' => 'admin', 'group_name' => 'career_management']);

        Permission::create(['name' => 'settings-page','guard_name' => 'admin', 'group_name' => 'custome_page_management']);
        Permission::create(['name' => 'create-page','guard_name' => 'admin', 'group_name' => 'custome_page_management']);
        Permission::create(['name' => 'pages','guard_name' => 'admin', 'group_name' => 'custome_page_management']);

        Permission::create(['name' => 'calendars','guard_name' => 'admin', 'group_name' => 'event_calendars_management']);

        Permission::create(['name' => 'settings-package','guard_name' => 'admin', 'group_name' => 'package_management']);
        Permission::create(['name' => 'categories-package','guard_name' => 'admin', 'group_name' => 'package_management']);
        Permission::create(['name' => 'form-builder-package','guard_name' => 'admin', 'group_name' => 'package_management']);
        Permission::create(['name' => 'packages','guard_name' => 'admin', 'group_name' => 'package_management']);

        Permission::create(['name' => 'subscriptions','guard_name' => 'admin', 'group_name' => 'subscription_management']);
        Permission::create(['name' => 'subscription-request','guard_name' => 'admin', 'group_name' => 'subscription_management']);

        Permission::create(['name' => 'visibility','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'form-builder-quote','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'all-quotes','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'pending-quotes','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'processing-quotes','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'completed-quotes','guard_name' => 'admin', 'group_name' => 'quote_management']);
        Permission::create(['name' => 'rejected-quotes','guard_name' => 'admin', 'group_name' => 'quote_management']);

        Permission::create(['name' => 'settings-shop','guard_name' => 'admin', 'group_name' => 'shop_management']);
        Permission::create(['name' => 'popular-tags','guard_name' => 'admin', 'group_name' => 'shop_management']);
        Permission::create(['name' => 'shipping-charges','guard_name' => 'admin', 'group_name' => 'shop_management']);
        Permission::create(['name' => 'coupons','guard_name' => 'admin', 'group_name' => 'shop_management']);

        Permission::create(['name' => 'category-product','guard_name' => 'admin', 'group_name' => 'product_management']);
        Permission::create(['name' => 'products','guard_name' => 'admin', 'group_name' => 'product_management']);

        Permission::create(['name' => 'all-orders','guard_name' => 'admin', 'group_name' => 'order_management']);
        Permission::create(['name' => 'pending-orders','guard_name' => 'admin', 'group_name' => 'order_management']);
        Permission::create(['name' => 'processing-orders','guard_name' => 'admin', 'group_name' => 'order_management']);
        Permission::create(['name' => 'completed-orders','guard_name' => 'admin', 'group_name' => 'order_management']);
        Permission::create(['name' => 'rejected-orders','guard_name' => 'admin', 'group_name' => 'order_management']);
        Permission::create(['name' => 'report-order','guard_name' => 'admin', 'group_name' => 'order_management']);

        Permission::create(['name' => 'settings-course','guard_name' => 'admin', 'group_name' => 'course_management']);
        Permission::create(['name' => 'categories-course','guard_name' => 'admin', 'group_name' => 'course_management']);
        Permission::create(['name' => 'courses','guard_name' => 'admin', 'group_name' => 'course_management']);
        Permission::create(['name' => 'enrolls','guard_name' => 'admin', 'group_name' => 'course_management']);
        Permission::create(['name' => 'report-course','guard_name' => 'admin', 'group_name' => 'course_management']);

        Permission::create(['name' => 'settings-event','guard_name' => 'admin', 'group_name' => 'event_management']);
        Permission::create(['name' => 'categories-event','guard_name' => 'admin', 'group_name' => 'event_management']);
        Permission::create(['name' => 'all-events','guard_name' => 'admin', 'group_name' => 'event_management']);
        Permission::create(['name' => 'booking','guard_name' => 'admin', 'group_name' => 'event_management']);
        Permission::create(['name' => 'report-event','guard_name' => 'admin', 'group_name' => 'event_management']);

        Permission::create(['name' => 'settings-donation','guard_name' => 'admin', 'group_name' => 'donation_management']);
        Permission::create(['name' => 'all-cause','guard_name' => 'admin', 'group_name' => 'donation_management']);
        Permission::create(['name' => 'donations','guard_name' => 'admin', 'group_name' => 'donation_management']);
        Permission::create(['name' => 'report-donation','guard_name' => 'admin', 'group_name' => 'donation_management']);
        
        Permission::create(['name' => 'categories-acknowledged','guard_name' => 'admin', 'group_name' => 'acknowledged_management']);
        Permission::create(['name' => 'articles','guard_name' => 'admin', 'group_name' => 'acknowledged_management']);

        Permission::create(['name' => 'settings-tickets','guard_name' => 'admin', 'group_name' => 'support_tickets_management']);
        Permission::create(['name' => 'all-tickets','guard_name' => 'admin', 'group_name' => 'support_tickets_management']);
        Permission::create(['name' => 'pending-tickets','guard_name' => 'admin', 'group_name' => 'support_tickets_management']);
        Permission::create(['name' => 'open-tickets','guard_name' => 'admin', 'group_name' => 'support_tickets_management']);
        Permission::create(['name' => 'close-tickets','guard_name' => 'admin', 'group_name' => 'support_tickets_management']);

        Permission::create(['name' => 'import-rss','guard_name' => 'admin', 'group_name' => 'rss_management']);
        Permission::create(['name' => 'rss-feeds','guard_name' => 'admin', 'group_name' => 'rss_management']);
        Permission::create(['name' => 'rss-posts','guard_name' => 'admin', 'group_name' => 'rss_management']);

        Permission::create(['name' => 'register-users','guard_name' => 'admin', 'group_name' => 'users_management']);
        Permission::create(['name' => 'push-notification','guard_name' => 'admin', 'group_name' => 'users_management']);
        Permission::create(['name' => 'subscribers','guard_name' => 'admin', 'group_name' => 'users_management']);

        Permission::create(['name' => 'popups','guard_name' => 'admin', 'group_name' => 'announcement_management']);

        Permission::create(['name' => 'general-settings','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'email-settings','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'file-manager','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'logo-text-header','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'preloader','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'preferences','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'support-information','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'social-links','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'page-headings','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'payment-gateways','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'language','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'plugins','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'seo-information','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'maintenance-mode','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'cookies-alert','guard_name' => 'admin', 'group_name' => 'settings']);
        Permission::create(['name' => 'misc','guard_name' => 'admin', 'group_name' => 'settings']);

        Permission::create(['name' => 'profile','guard_name' => 'admin', 'group_name' => 'profile_management']);
        Permission::create(['name' => 'change-password','guard_name' => 'admin', 'group_name' => 'profile_management']);

        Permission::create(['name' => 'roles','guard_name' => 'admin', 'group_name' => 'admin_management']);
        Permission::create(['name' => 'admins','guard_name' => 'admin', 'group_name' => 'admin_management']);

        Permission::create(['name' => 'client-feedback','guard_name' => 'admin', 'group_name' => 'feedbacks_management']);
        

        $superAdminRole = Role::create(['name' => 'Super Admin','guard_name' => 'admin']);
        $adminRole = Role::create(['name' => 'Admin','guard_name' => 'admin']);

        $superuser = Admin::create([
            'role_id' => $superAdminRole->id,
            'first_name' => 'EncureIt',
            'last_name' => 'Admin',
            'username' => 'encureit@admin.com',
            'email' => 'encureit@admin.com',
            'password' => Hash::make('EncureIt@1008')
        ]);

        $user = Admin::create([
            'role_id' => $adminRole->id,
            'first_name' => 'Admin',
            'last_name' => 'test',
            'username' => 'admin@admin.com',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456')
        ]);

        $superAdminRole->givePermissionTo([
            'theme-setting',
            'mega-menus',
            'main-menus',
            'permalinks',
            'hero-section',
            'features',
            'intro-section',
            'service-section',
            'approach-section',
            'statistics-section',
            'call-to-action-section',
            'portfolio-section',
            'testimonials-section',
            'team-section',
            'blog-section',
            'partners-section',
            'sections-customization',
            'portfolios',
            'logo-text',
            'useful-links',
            'settings-services',
            'category-services',
            'services',
            'category-blog',
            'blogs',
            'archives',
            'settings-gallery',
            'categories-gallery',
            'galleries',
            'settings-faq',
            'categories-faq',
            'faqs',
            'categories-career',
            'post-job',
            'job-management',
            'settings-page',
            'create-page',
            'pages',
            'calendars',
            'settings-package',
            'categories-package',
            'form-builder-package',
            'packages',
            'subscriptions',
            'subscription-request',
            'visibility',
            'form-builder-quote',
            'all-quotes',
            'pending-quotes',
            'processing-quotes',
            'completed-quotes',
            'rejected-quotes',
            'settings-shop',
            'popular-tags',
            'shipping-charges',
            'coupons',
            'category-product',
            'products',
            'all-orders',
            'pending-orders',
            'processing-orders',
            'completed-orders',
            'rejected-orders',
            'report-order',
            'settings-course',
            'categories-course',
            'courses',
            'enrolls',
            'report-course',
            'settings-event',
            'categories-event',
            'all-events',
            'booking',
            'report-event',
            'settings-donation',
            'all-cause',
            'donations',
            'report-donation',
            'categories-acknowledged',
            'articles',
            'settings-tickets',
            'all-tickets',
            'pending-tickets',
            'open-tickets',
            'close-tickets',
            'import-rss',
            'rss-feeds',
            'rss-posts',
            'register-users',
            'push-notification',
            'subscribers',
            'popups',
            'general-settings',
            'email-settings',
            'file-manager',
            'logo-text-header',
            'preloader',
            'preferences',
            'support-information',
            'social-links',
            'page-headings',
            'payment-gateways',
            'language',
            'plugins',
            'seo-information',
            'maintenance-mode',
            'cookies-alert',
            'misc',
            'roles',
            'admins',
            'client-feedback',
        ]);

        $superuser->assignRole([$superAdminRole->id]);
        $user->assignRole([$adminRole->id]);
        
    }
}
