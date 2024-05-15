@php
$default = \App\Models\Language::where('is_default', 1)->first();
$data = \App\Models\BasicExtra::first();
@endphp
<div class="sidebar sidebar-style-2" data-background-color="light2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          @if (!empty(Auth::guard('admin')->user()->image))
          <img src="{{asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image)}}" alt="..."
            class="avatar-img rounded">
          @else
          <img src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..." class="avatar-img rounded">
          @endif
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
          <span>
          {{Auth::guard('admin')->user()->first_name}}
          @if (empty(Auth::guard('admin')->user()->role))
          <span class="user-level">Owner</span>
          @else
          <span class="user-level">{{Auth::guard('admin')->user()->role->name}}</span>
          @endif
          <span class="caret"></span>
          </span>
          </a>
          <div class="clearfix"></div>
          <div class="collapse in" id="collapseExample">
            <ul class="nav">
              <li>
                <a href="{{route('admin.editProfile')}}">
                <span class="link-collapse">Edit Profile</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.changePass')}}">
                <span class="link-collapse">Change Password</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.logout')}}">
                <span class="link-collapse">Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <ul class="nav nav-primary mt-0">
        <div class="row mb-2">
          <div class="col-12">
            <form action="">
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search" value="" placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>


        @can('dashboard')
        {{-- Dashboard --}}
        <li class="nav-item @if(request()->path() == 'admin/dashboard') active @endif">
          <a href="{{route('admin.dashboard')}}">
            <i class="la flaticon-paint-palette"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endcan

        @can('theme-setting')
        {{-- Dynamic Pages --}}
        <li class="nav-item
          @if(request()->path() == 'admin/home-settings') active
          @elseif(request()->path() == 'admin/home-page') active
          @endif">
          <a data-toggle="collapse" href="#themeHome">
            <i class="la flaticon-file"></i>
            <p>Theme & Home
              @if ($bex->home_page_pagebuilder == 1)
              <span class="badge badge-danger p-1 sidenav-badge">Pagebuilder</span>
              @endif
            </p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/home-settings') show
            @elseif(request()->path() == 'admin/home-page') show
            @endif" id="themeHome">
            <ul class="nav nav-collapse">
              <li class="@if(request()->path() == 'admin/home-settings') active @endif">
                <a href="{{route('admin.homeSettings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @if ($bex->home_page_pagebuilder == 1)
              <li class="@if(request()->path() == 'admin/home-page') active @endif">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#pbLangModal">
                <span class="sub-item">Home Page Content</span>
                </a>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endcan



        @canany(['mega-menus','main-menus','permalinks'])
        {{-- Menu Builder--}}
        <li class="nav-item
          @if(request()->path() == 'admin/menu-builder') active
          @elseif(request()->path() == 'admin/megamenus') active
          @elseif(request()->path() == 'admin/megamenus/edit') active
          @elseif(request()->path() == 'admin/permalinks') active
          @endif">
          <a data-toggle="collapse" href="#websiteMenu">
            <i class="fas fa-ellipsis-v"></i>
            <p>Website Menu Builder</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/menu-builder') show
            @elseif(request()->path() == 'admin/megamenus') show
            @elseif(request()->path() == 'admin/permalinks') show
            @elseif(request()->path() == 'admin/megamenus/edit') show
            @endif" id="websiteMenu">
            <ul class="nav nav-collapse">
              @can('mega-menus')
              <li class="@if(request()->path() == 'admin/megamenus') active
                @elseif(request()->path() == 'admin/megamenus/edit') active
                @endif">
                <a href="{{route('admin.megamenus') . '?language=' . $default->code}}">
                <span class="sub-item">Mega Menus</span>
                </a>
              </li>
              @endcan
              @can('main-menus')
              <li class="@if(request()->path() == 'admin/menu-builder') active @endif">
                <a href="{{route('admin.menu_builder.index') . '?language=' . $default->code}}">
                <span class="sub-item">Main Menu</span>
                </a>
              </li>
              @endcan
              @can('permalinks')
              <li class="@if(request()->path() == 'admin/permalinks') active @endif">
                <a href="{{route('admin.permalinks.index')}}">
                <span class="sub-item">Permalinks</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany

        {{-- Content Management --}}
        @canany(['sections-customization','shareholder-section','blog-section','team-section','testimonials-section','portfolio-section','call-to-action-section','statistics-section','approach-section','service-section','intro-section','features','hero-section','logo-text','useful-links','department-links','about-us-links', 'settings-services','category-services','services','portfolios','category-blog','blogs','archives','settings-gallery','categories-gallery','galleries','settings-faq','categories-faq','faqs','categories-career','post-job','job-management'])
        @includeIf('admin.partials.content-management')
        @endcanany

        {{-- Tenders Management --}}
        @canany(['categories-tender', 'tenders'])
        <li class="nav-item
          @if(request()->path() == 'admin/tender_category') active
          @elseif(request()->path() == 'admin/tenders') active
          @elseif(request()->is('admin/tender/edit/*')) active
          @elseif(request()->is('admin/tender/add')) active
          @endif">
          <a data-toggle="collapse" href="#tenders">
            <i class="la flaticon-file"></i>
            <p>Tenders Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/tender_category') show
            @elseif(request()->path() == 'admin/tenders') show
            @elseif(request()->path() == 'admin/tender/edit/*') show
            @elseif(request()->path() == 'admin/tender/add') show
            @endif" id="tenders">
            <ul class="nav nav-collapse">
              @can('categories-tender')
              <li class="@if(request()->path() == 'admin/tender_category') active @endif">
                <a href="{{route('admin.tcategory.index') . '?language=' . $default->code}}">
                <span class="sub-item">Tender Category</span>
                </a>
              </li>
              @endcan
              @can('tenders')
              <li class="@if(request()->path() == 'admin/tenders') active
              @elseif(request()->is('admin/tender/edit/*')) active
              @elseif(request()->is('admin/tender/add')) active
                @endif">
                <a href="{{route('admin.tenders.index') . '?language=' . $default->code}}">
                <span class="sub-item">Tenders</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany

        {{-- Leadership Management --}}
        @canany(['categories-leadership', 'leadership'])
        {{-- Articles --}}
        <li class="nav-item
          @if(request()->path() == 'admin/leadership_categories') active
    
          @endif">
          <a data-toggle="collapse" href="#leadership">
            <i class="la flaticon-users"></i>
            <p>Leadership Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/leadership_categories') show
  
            @endif" id="leadership">
            <ul class="nav nav-collapse">
              @can('categories-leadership')
              <li class="@if(request()->path() == 'admin/leadership_categories') active @endif">
                <a href="{{route('admin.leadership_category.index') . '?language=' . $default->code}}">
                <span class="sub-item">Leadership Category</span>
                </a>
              </li>
              @endcan
              @can('leadership')
              <li class="@if(request()->path() == 'admin/leadership') show
                
                @endif">
                <a href="{{route('admin.leadership.index') . '?language=' . $default->code}}">
                <span class="sub-item">Leadership</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany
        {{---Documents---}}
        @canany(['categories-document', 'documents'])
        {{-- Articles --}}
        <li class="nav-item
          @if(request()->path() == 'document_category') active
    
          @endif">
          <a data-toggle="collapse" href="#document">
            <i class="la flaticon-users"></i>
            <p>Documents</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/document_category') show
  
            @endif" id="document">
            <ul class="nav nav-collapse">
              @can('categories-document')
              <li class="@if(request()->path() == 'admin/document_category') active @endif">
                <a href="{{route('admin.dcategory.index') . '?language=' . $default->code}}">
                <span class="sub-item">Document Category</span>
                </a>
              </li>
              @endcan
              @can('documents')
              <li class="@if(request()->path() == 'documents') show
                
                @endif">
                <a href="{{route('admin.documents.index') . '?language=' . $default->code}}">
                <span class="sub-item">Documents</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany
        @can('water-teriff-charges')
        {{-- history --}}
        <li class="nav-item">
          <a href="{{route('admin.water.index')}}">
            <i class="fas fa-book-open"></i>
            <p>Water Tarrif</p>
          </a>
        </li>
        @endcan
        @can('history')
        {{-- history --}}
        <li class="nav-item">
          <a href="{{route('admin.index')}}">
            <i class="fas fa-book-open"></i>
            <p>History</p>
          </a>
        </li>
        @endcan

        @can('e-governance')
        {{-- e-governance --}}
        <li class="nav-item">
          <a href="{{route('admin.egovernance.index')}}">
            <i class="la flaticon-web-1"></i>
            <p>E-Governance</p>
          </a>
        </li>
        @endcan


        @can('profit-budget-chart')
        {{-- profit-budget-chart --}}
        <li class="nav-item">
          <a href="{{route('admin.profit.index')}}">
            <i class="la flaticon-graph"></i>
            <p>Profit Budget</p>
          </a>
        </li>
        @endcan

        
        @canany(['settings-page','create-page','pages'])
        {{-- Dynamic Pages --}}
        <li class="nav-item
          @if(request()->path() == 'admin/page/create') active
          @elseif(request()->path() == 'admin/page/settings') active
          @elseif(request()->path() == 'admin/pages') active
          @elseif(request()->is('admin/page/*/edit')) active
          @endif">
          <a data-toggle="collapse" href="#pages">
            <i class="la flaticon-file"></i>
            <p>Custom Pages <span class="badge badge-danger p-1 sidenav-badge">Pagebuilder</span></p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/page/create') show
            @elseif(request()->path() == 'admin/page/settings') show
            @elseif(request()->path() == 'admin/pages') show
            @elseif(request()->is('admin/page/*/edit')) show
            @endif" id="pages">
            <ul class="nav nav-collapse">
              @can('settings-page')
              <li class="@if(request()->path() == 'admin/page/settings') active @endif">
                <a href="{{route('admin.page.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('create-page')
              <li class="@if(request()->path() == 'admin/page/create') active @endif">
                <a href="{{route('admin.page.create') . '?language=' . $default->code}}">
                <span class="sub-item">Create Page</span>
                </a>
              </li>
              @endcan
              @can('pages')
              <li class="@if(request()->path() == 'admin/pages') active @endif">
                <a href="{{route('admin.page.index') . '?language=' . $default->code}}">
                <span class="sub-item">Pages</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany

        @can('news')
        {{-- Event Calendar --}}
        <li class="nav-item
          @if(request()->path() == 'admin/news') active
          @endif">
          <a href="{{route('admin.news.index') . '?language=' . $default->code}}">
            <i class="la flaticon-calendar"></i>
            <p>
              {{$be->theme_version == 'stem' ? 'News Section' : 'Event Calendar'}}</p>
          </a>
        </li>
        @endcan

    
        {{-- Package Management --}}
        @canany(['settings-package','categories-package','form-builder-package','packages','subscriptions','subscription-request'])

        
        <li class="nav-item
          @if(request()->path() == 'admin/packages') active
          @elseif(request()->routeIs('admin.package.edit')) active
          @elseif(request()->path() == 'admin/package/form') active
          @elseif(request()->is('admin/package/*/inputEdit')) active
          @elseif(request()->path() == 'admin/all/orders') active
          @elseif(request()->path() == 'admin/pending/orders') active
          @elseif(request()->path() == 'admin/processing/orders') active
          @elseif(request()->path() == 'admin/completed/orders') active
          @elseif(request()->path() == 'admin/rejected/orders') active
          @elseif(request()->path() == 'admin/package/settings') active
          @elseif(request()->path() == 'admin/package/categories') active
          @elseif(request()->routeIs('admin.subscriptions')) active
          @elseif(request()->path() == 'admin/package/order/report') active
          @endif"
          >
          <a data-toggle="collapse" href="#packages">
            <i class="la flaticon-box-1"></i>
            <p>Package Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/packages') show
            @elseif(request()->routeIs('admin.package.edit')) show
            @elseif(request()->path() == 'admin/package/form') show
            @elseif(request()->is('admin/package/*/inputEdit')) show
            @elseif(request()->path() == 'admin/all/orders') show
            @elseif(request()->path() == 'admin/pending/orders') show
            @elseif(request()->path() == 'admin/processing/orders') show
            @elseif(request()->path() == 'admin/completed/orders') show
            @elseif(request()->path() == 'admin/rejected/orders') show
            @elseif(request()->path() == 'admin/package/settings') show
            @elseif(request()->path() == 'admin/package/categories') show
            @elseif(request()->routeIs('admin.subscriptions')) show
            @elseif(request()->path() == 'admin/package/order/report') show
            @endif" id="packages"
            >
            <ul class="nav nav-collapse">
              @can('settings-package')
              <li class="@if(request()->path() == 'admin/package/settings') active @endif">
                <a href="{{route('admin.package.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('categories-package')
              @if ($data->package_category_status == 1)
              <li class="@if(request()->path() == 'admin/package/categories') active @endif">
                <a href="{{route('admin.package.categories') . '?language=' . $default->code}}">
                <span class="sub-item">Categories</span>
                </a>
              </li>
              @endif
              @endcan

              @can('form-builder-package')
              <li class="@if(request()->path() == 'admin/package/form') active
                @elseif(request()->is('admin/package/*/inputEdit')) active
                @endif"
                >
                <a href="{{route('admin.package.form') . '?language=' . $default->code}}">
                <span class="sub-item">Form Builder</span>
                </a>
              </li>
              @endcan
              @can('packages')
              <li class="@if(request()->path() == 'admin/packages') active
                @elseif(request()->routeIs('admin.package.edit')) active
                @endif"
                >
                <a href="{{route('admin.package.index') . '?language=' . $default->code}}">
                <span class="sub-item">Packages</span>
                </a>
              </li>
              @endcan
           

              @if ($bex->recurring_billing == 1)
              @can('subscriptions')
              <li class="submenu">
                <a data-toggle="collapse" href="#manageSubscriptions"
                  aria-expanded="{{((request()->routeIs('admin.subscriptions') && request()->input('type') != 'request')) ? 'true' : 'false' }}">
                <span class="sub-item">Subscriptions</span>
                <span class="caret"></span>
                </a>
                <div class="collapse @if((request()->routeIs('admin.subscriptions') && request()->input('type') != 'request')) show @endif" id="manageSubscriptions" style="">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->routeIs('admin.subscriptions') && request()->input('type') == 'all') active @endif">
                      <a href="{{route('admin.subscriptions', ['type' => 'all'])}}">
                      <span class="sub-item">All Subscriptions</span>
                      </a>
                    </li>
                    <li class="@if(request()->routeIs('admin.subscriptions') && request()->input('type') == 'active') active @endif">
                      <a href="{{route('admin.subscriptions', ['type' => 'active'])}}">
                      <span class="sub-item">Active Subscriptions</span>
                      </a>
                    </li>
                    <li class="@if(request()->routeIs('admin.subscriptions') && request()->input('type') == 'expired') active @endif">
                      <a href="{{route('admin.subscriptions', ['type' => 'expired'])}}">
                      <span class="sub-item">Expired Subscriptions</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
              @can('subscription-request')
              <li class="@if(request()->routeIs('admin.subscriptions') && request()->input('type') == 'request') active @endif">
                <a href="{{route('admin.subscriptions', ['type' => 'request'])}}">
                <span class="sub-item">Subscription Requests</span>
                </a>
              </li>
              @endcan
              @endif
              @if ($bex->recurring_billing == 0)
              <li class="submenu">
                <a data-toggle="collapse" href="#packageOrders"
                  aria-expanded="{{(request()->path() == 'admin/all/orders' || request()->path() == 'admin/pending/orders' || request()->path() == 'admin/processing/orders' || request()->path() == 'admin/completed/orders' || request()->path() == 'admin/rejected/orders' || request()->path() == 'admin/package/order/report') ? 'true' : 'false' }}">
                <span class="sub-item">Manage Orders</span>
                <span class="caret"></span>
                </a>
                <div class="collapse {{(request()->path() == 'admin/all/orders' || request()->path() == 'admin/pending/orders' || request()->path() == 'admin/processing/orders' || request()->path() == 'admin/completed/orders' || request()->path() == 'admin/package/order/report') ? 'show' : '' }}" id="packageOrders" style="">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->path() == 'admin/all/orders') active @endif">
                      <a href="{{route('admin.all.orders')}}">
                      <span class="sub-item">All Orders</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/pending/orders') active @endif">
                      <a href="{{route('admin.pending.orders')}}">
                      <span class="sub-item">Pending Orders</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/processing/orders') active @endif">
                      <a href="{{route('admin.processing.orders')}}">
                      <span class="sub-item">Processing Orders</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/completed/orders') active @endif">
                      <a href="{{route('admin.completed.orders')}}">
                      <span class="sub-item">Completed Orders</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/rejected/orders') active @endif">
                      <a href="{{route('admin.rejected.orders')}}">
                      <span class="sub-item">Rejected Orders</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/package/order/report') active @endif">
                      <a href="{{route('admin.package.report')}}">
                      <span class="sub-item">Report</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endif
            </ul>
          </div>
        </li>
        @endcanany

        @canany(['visibility','form-builder-quote','all-quotes','pending-quotes','processing-quotes','completed-quotes','rejected-quotes'])


        {{-- Quotes --}}
        <li class="nav-item
          @if(request()->path() == 'admin/quote/form') active
          @elseif(request()->is('admin/quote/*/inputEdit')) active
          @elseif(request()->path() == 'admin/all/quotes') active
          @elseif(request()->path() == 'admin/pending/quotes') active
          @elseif(request()->path() == 'admin/processing/quotes') active
          @elseif(request()->path() == 'admin/completed/quotes') active
          @elseif(request()->path() == 'admin/rejected/quotes') active
          @elseif(request()->path() == 'admin/quote/visibility') active
          @endif">
          <a data-toggle="collapse" href="#quote">
            <i class="la flaticon-list"></i>
            <p>Quote Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/quote/form') show
            @elseif(request()->is('admin/quote/*/inputEdit')) show
            @elseif(request()->path() == 'admin/all/quotes') show
            @elseif(request()->path() == 'admin/pending/quotes') show
            @elseif(request()->path() == 'admin/processing/quotes') show
            @elseif(request()->path() == 'admin/completed/quotes') show
            @elseif(request()->path() == 'admin/rejected/quotes') show
            @elseif(request()->path() == 'admin/quote/visibility') show
            @endif" id="quote">
            <ul class="nav nav-collapse">
              @can('visibility')
              <li class="
                @if(request()->path() == 'admin/quote/visibility') active
                @endif">
                <a href="{{route('admin.quote.visibility')}}">
                <span class="sub-item">Visibility</span>
                </a>
              </li>
              @endcan
              @can('form-builder-quote')
              <li class="
                @if(request()->path() == 'admin/quote/form') active
                @elseif(request()->is('admin/quote/*/inputEdit')) active
                @endif">
                <a href="{{route('admin.quote.form') . '?language=' . $default->code}}">
                <span class="sub-item">Form Builder</span>
                </a>
              </li>
              @endcan
              @can('all-quotes')
              <li class="@if(request()->path() == 'admin/all/quotes') active @endif">
                <a href="{{route('admin.all.quotes')}}">
                <span class="sub-item">All Quotes</span>
                </a>
              </li>
              @endcan
              @can('pending-quotes')
              <li class="@if(request()->path() == 'admin/pending/quotes') active @endif">
                <a href="{{route('admin.pending.quotes')}}">
                <span class="sub-item">Pending Quotes</span>
                </a>
              </li>
              @endcan
              @can('processing-quotes')
              <li class="@if(request()->path() == 'admin/processing/quotes') active @endif">
                <a href="{{route('admin.processing.quotes')}}">
                <span class="sub-item">Processing Quotes</span>
                </a>
              </li>
              @endcan
              @can('completed-quotes')
              <li class="@if(request()->path() == 'admin/completed/quotes') active @endif">
                <a href="{{route('admin.completed.quotes')}}">
                <span class="sub-item">Completed Quotes</span>
                </a>
              </li>
              @endcan
              @can('rejected-quotes')
              <li class="@if(request()->path() == 'admin/rejected/quotes') active @endif">
                <a href="{{route('admin.rejected.quotes')}}">
                <span class="sub-item">Rejected Quotes</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany


       @canany(['settings-shop', 'popular-tags', 'shipping-charges','coupons'])
        {{-- Product --}}
        <li class="nav-item
          @if(request()->path() == 'admin/category') active
          @elseif(request()->path() == 'admin/product') active
          @elseif(request()->routeIs('admin.product.type')) active
          @elseif(request()->is('admin/product/*/edit')) active
          @elseif(request()->is('admin/category/*/edit')) active
          @elseif(request()->path() == 'admin/product/all/orders') active
          @elseif(request()->path() == 'admin/product/pending/orders') active
          @elseif(request()->path() == 'admin/product/processing/orders') active
          @elseif(request()->path() == 'admin/product/completed/orders') active
          @elseif(request()->path() == 'admin/product/rejected/orders') active
          @elseif(request()->routeIs('admin.product.create')) active
          @elseif(request()->routeIs('admin.product.details')) active
          @elseif(request()->path() == 'admin/coupon') active
          @elseif(request()->routeIs('admin.coupon.edit')) active
          @elseif(request()->path() == 'admin/shipping') active
          @elseif(request()->routeIs('admin.shipping.edit')) active
          @elseif(request()->routeIs('admin.product.tags')) active
          @elseif(request()->routeIs('admin.product.settings')) active
          @elseif(request()->path() == 'admin/product/orders/report') active
          @endif">
          <a data-toggle="collapse" href="#category">
            <i class="fas fa-store-alt"></i>
            <p>Shop Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/category') show
            @elseif(request()->is('admin/category/*/edit')) show
            @elseif(request()->routeIs('admin.product.type')) show
            @elseif(request()->path() == 'admin/product') show
            @elseif(request()->is('admin/product/*/edit')) show
            @elseif(request()->path() == 'admin/product/all/orders') show
            @elseif(request()->path() == 'admin/product/pending/orders') show
            @elseif(request()->path() == 'admin/product/processing/orders') show
            @elseif(request()->path() == 'admin/product/completed/orders') show
            @elseif(request()->path() == 'admin/product/rejected/orders') show
            @elseif(request()->routeIs('admin.product.create')) show
            @elseif(request()->routeIs('admin.product.details')) show
            @elseif(request()->path() == 'admin/coupon') show
            @elseif(request()->routeIs('admin.coupon.edit')) show
            @elseif(request()->path() == 'admin/shipping') show
            @elseif(request()->routeIs('admin.shipping.edit')) show
            @elseif(request()->routeIs('admin.product.tags')) show
            @elseif(request()->routeIs('admin.product.settings')) show
            @elseif(request()->path() == 'admin/product/orders/report') show
            @endif" id="category">
            <ul class="nav nav-collapse">
              @can('settings-shop')
              <li class="@if(request()->routeIs('admin.product.settings')) active @endif">
                <a href="{{route('admin.product.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('popular-tags')
              <li class="@if(request()->routeIs('admin.product.tags')) active @endif">
                <a href="{{route('admin.product.tags'). '?language=' . $default->code}}">
                <span class="sub-item">Popular Tags</span>
                </a>
              </li>
              @endcan
              @can('shipping-charges')
              @if ($bex->catalog_mode == 0)
              <li class="
                @if(request()->path() == 'admin/shipping') active
                @elseif(request()->routeIs('admin.shipping.edit')) active
                @endif">
                <a href="{{route('admin.shipping.index'). '?language=' . $default->code}}">
                <span class="sub-item">Shipping Charges</span>
                </a>
              </li>
              @endif
              @endcan
              @can('coupons')
              @if ($bex->catalog_mode == 0)
              <li class="
                @if(request()->path() == 'admin/coupon') active
                @elseif(request()->routeIs('admin.coupon.edit')) active
                @endif">
                <a href="{{route('admin.coupon.index')}}">
                <span class="sub-item">Coupons</span>
                </a>
              </li>
              @endif
              @endcan
              @canany(['category-product', 'products'])
              <li class="submenu">
                <a data-toggle="collapse" href="#productManagement"
                  aria-expanded="{{(request()->path() == 'admin/category' || request()->is('admin/category/*/edit') || request()->routeIs('admin.product.type') || request()->routeIs('admin.product.create') || request()->routeIs('admin.product.index') || request()->routeIs('admin.product.edit')) ? 'true' : 'false' }}">
                <span class="sub-item">Manage Products</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->path() == 'admin/category') show
                  @elseif(request()->is('admin/category/*/edit')) show
                  @elseif(request()->routeIs('admin.product.type')) show
                  @elseif(request()->routeIs('admin.product.create')) show
                  @elseif(request()->routeIs('admin.product.index')) show
                  @elseif(request()->routeIs('admin.product.edit')) show
                  @endif" id="productManagement" style="">
                  <ul class="nav nav-collapse subnav">
                    @can('category-product')
                    <li class="
                      @if(request()->path() == 'admin/category') active
                      @elseif(request()->is('admin/category/*/edit')) active
                      @endif">
                      <a href="{{route('admin.category.index') . '?language=' . $default->code}}">
                      <span class="sub-item">Category</span>
                      </a>
                    </li>
                    
                    <li class="
                      @if(request()->routeIs('admin.product.type')) active
                      @elseif(request()->routeIs('admin.product.create')) active
                      @endif">
                      <a href="{{route('admin.product.type')}}">
                      <span class="sub-item">Add Product</span>
                      </a>
                    </li>
                    @endcan
                    @can('products')
                    <li class="
                      @if(request()->path() == 'admin/product') active
                      @elseif(request()->is('admin/product/*/edit')) active
                      @endif">
                      <a href="{{route('admin.product.index'). '?language=' . $default->code}}">
                      <span class="sub-item">Products</span>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </div>
              </li>
              @endcanany

              @canany(['all-orders', 'pending-orders', 'processing-orders','completed-orders','rejected-orders','report-order'])
              @if ($bex->catalog_mode == 0)
              <li class="submenu">
                <a data-toggle="collapse" href="#manageOrders"
                  aria-expanded="{{(request()->routeIs('admin.all.product.orders') || request()->routeIs('admin.pending.product.orders') || request()->routeIs('admin.processing.product.orders') || request()->routeIs('admin.completed.product.orders') || request()->routeIs('admin.rejected.product.orders') || request()->routeIs('admin.product.details') || (request()->path() == 'admin/product/orders/report')) ? 'true' : 'false' }}">
                <span class="sub-item">Manage Orders</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->routeIs('admin.all.product.orders')) show
                  @elseif(request()->routeIs('admin.pending.product.orders')) show
                  @elseif(request()->routeIs('admin.processing.product.orders')) show
                  @elseif(request()->routeIs('admin.completed.product.orders')) show
                  @elseif(request()->routeIs('admin.rejected.product.orders')) show
                  @elseif(request()->routeIs('admin.product.details')) show
                  @elseif(request()->path() == 'admin/product/orders/report') show
                  @endif" id="manageOrders" style="">
                  <ul class="nav nav-collapse subnav">
                    @can('all-orders')
                    <li class="@if(request()->path() == 'admin/product/all/orders') active @endif">
                      <a href="{{route('admin.all.product.orders')}}">
                      <span class="sub-item">All Orders</span>
                      </a>
                    </li>
                    @endcan
                    @can('pending-orders')
                    <li class="@if(request()->path() == 'admin/product/pending/orders') active @endif">
                      <a href="{{route('admin.pending.product.orders')}}">
                      <span class="sub-item">Pending Orders</span>
                      </a>
                    </li>
                    @endcan
                    @can('processing-orders')
                    <li class="@if(request()->path() == 'admin/product/processing/orders') active @endif">
                      <a href="{{route('admin.processing.product.orders')}}">
                      <span class="sub-item">Processing Orders</span>
                      </a>
                    </li>
                    @endcan
                    @can('completed-orders')
                    <li class="@if(request()->path() == 'admin/product/completed/orders') active @endif">
                      <a href="{{route('admin.completed.product.orders')}}">
                      <span class="sub-item">Completed Orders</span>
                      </a>
                    </li>
                    @endcan
                    @can('rejected-orders')
                    <li class="@if(request()->path() == 'admin/product/rejected/orders') active @endif">
                      <a href="{{route('admin.rejected.product.orders')}}">
                      <span class="sub-item">Rejected Orders</span>
                      </a>
                    </li>
                    @endcan
                    @can('report-order')
                    <li class="@if(request()->path() == 'admin/product/orders/report') active @endif">
                      <a href="{{route('admin.orders.report')}}">
                      <span class="sub-item">Report</span>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </div>
              </li>
              @endif
              @endcanany
            </ul>
          </div>
        </li>
        @endcanany


      @canany(['settings-course', 'categories-course', 'courses','enrolls','report-course'])
        {{-- Courses --}}
        <li class="nav-item
          @if(request()->path() == 'admin/course_categories') active
          @elseif(request()->path() == 'admin/course/settings') active
          @elseif(request()->path() == 'admin/course/purchase-log') active
          @elseif(request()->path() == 'admin/courses') active
          @elseif(request()->path() == 'admin/course/create') active
          @elseif(request()->is('admin/course/*/edit')) active
          @elseif(request()->is('admin/course/*/modules')) active
          @elseif(request()->is('admin/module/*/lessons')) active
          @elseif(request()->path() == 'admin/course/enrolls/report') active
          @endif">
          <a data-toggle="collapse" href="#course">
            <i class='fas fa-book-open'></i>
            <p>Course Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/course_categories') show
            @elseif(request()->path() == 'admin/course/settings') show
            @elseif(request()->path() == 'admin/course/purchase-log') show
            @elseif(request()->path() == 'admin/courses') show
            @elseif(request()->path() == 'admin/course/create') show
            @elseif(request()->is('admin/course/*/edit')) show
            @elseif(request()->is('admin/course/*/modules')) show
            @elseif(request()->is('admin/module/*/lessons')) show
            @elseif(request()->path() == 'admin/course/enrolls/report') show
            @endif"
            id="course"
            >
            <ul class="nav nav-collapse">
              @can('settings-course')
              <li class="@if(request()->path() == 'admin/course/settings') active @endif">
                <a href="{{route('admin.course.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('categories-course')
              <li class="@if(request()->path() == 'admin/course_categories') active @endif">
                <a href="{{route('admin.course_category.index') . '?language=' . $default->code}}">
                <span class="sub-item">Category</span>
                </a>
              </li>
              
              <li class="@if(request()->path() == 'admin/course/create') active
                @endif">
                <a href="{{route('admin.course.create') . '?language=' . $default->code}}">
                <span class="sub-item">Add Course</span>
                </a>
              </li>
              @endcan
   
              @can('courses')
              <li class="@if(request()->path() == 'admin/courses') active
                @elseif(request()->is('admin/course/*/edit')) active
                @elseif(request()->is('admin/course/*/modules')) active
                @elseif(request()->is('admin/module/*/lessons')) active
                @endif">
                <a href="{{route('admin.course.index') . '?language=' . $default->code}}">
                <span class="sub-item">Courses</span>
                </a>
              </li>
              @endcan
              @can('enrolls')
              <li class="@if(request()->path() == 'admin/course/purchase-log') active @endif">
                <a href="{{route('admin.course.purchaseLog')}}">
                <span class="sub-item">Enrolls</span>
                </a>
              </li>
              @endcan
              @can('report-course')
              <li class="@if(request()->path() == 'admin/course/enrolls/report') active @endif">
                <a href="{{route('admin.enrolls.report')}}">
                <span class="sub-item">Report</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
       @endcanany



        {{-- Events Manage --}}
        @canany(['settings-event', 'categories-event', 'all-events','booking','report-event'])
        <li class="nav-item
          @if(request()->path() == 'admin/event/categories') active
          @elseif(request()->path() == 'admin/event/settings') active
          @elseif(request()->path() == 'admin/events') active
          @elseif(request()->path() == 'admin/events/payment-log') active
          @elseif(request()->is('admin/event/*/edit')) active
          @elseif(request()->path() == 'admin/events/report') active
          @endif">
          <a data-toggle="collapse" href="#event_manage">
            <i class="fas fa-calendar-alt"></i>
            <p>Events Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/event/categories') show
            @elseif(request()->path() == 'admin/event/settings') show
            @elseif(request()->path() == 'admin/events') show
            @elseif(request()->path() == 'admin/events/payment-log') show
            @elseif(request()->is('admin/event/*/edit')) show
            @elseif(request()->path() == 'admin/events/report') show
            @endif" id="event_manage">
            <ul class="nav nav-collapse">
              @can('settings-event')
              <li class="@if(request()->path() == 'admin/event/settings') active @endif">
                <a href="{{route('admin.event.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('categories-event')
              <li class="@if(request()->path() == 'admin/event/categories') active @endif">
                <a href="{{route('admin.event.category.index') . '?language=' . $default->code}}">
                <span class="sub-item">Category</span>
                </a>
              </li>
              @endcan
              @can('all-events')
              <li class="
                @if(request()->path() == 'admin/events') active
                @elseif(request()->is('admin/event/*/edit')) active
                @endif">
                <a href="{{route('admin.event.index') . '?language=' . $default->code}}">
                <span class="sub-item">All Events</span>
                </a>
              </li>
              @endcan
              @can('booking')
              <li class="@if(request()->path() == 'admin/events/payment-log') active @endif">
                <a href="{{route('admin.event.payment.log') . '?language=' . $default->code}}">
                <span class="sub-item">Bookings</span>
                </a>
              </li>
              @endcan
              @can('report-event')
              <li class="@if(request()->path() == 'admin/events/report') active @endif">
                <a href="{{route('admin.event.report')}}">
                <span class="sub-item">Report</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany


        @canany(['settings-donation', 'all-cause', 'donations','report-donation'])
        <li class="nav-item
          @if(request()->path() == 'admin/donations') active
          @elseif(request()->path() == 'admin/donations/payment-log') active
          @elseif(request()->path() == 'admin/donation/settings') active
          @elseif(request()->is('admin/donation/*/edit')) active
          @elseif(request()->path() == 'admin/donation/report') active
          @endif">
          <a data-toggle="collapse" href="#donation_manage">
            <i class="fas fa-hand-holding-usd"></i>
            <p>Donations & Causes</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/donations') show
            @elseif(request()->path() == 'admin/donations/payment-log') show
            @elseif(request()->is('admin/donation/*/edit')) show
            @elseif(request()->path() == 'admin/donation/settings') show
            @elseif(request()->path() == 'admin/donation/report') show
            @endif" id="donation_manage">
            <ul class="nav nav-collapse">
              @can('settings-donation')
              <li class="@if(request()->path() == 'admin/donation/settings') active @endif">
                <a href="{{route('admin.donation.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('all-cause')
              <li class="
                @if(request()->path() == 'admin/donations') active
                @elseif(request()->is('admin/donation/*/edit')) active
                @endif">
                <a href="{{route('admin.donation.index') . '?language=' . $default->code}}">
                <span class="sub-item">All Causes</span>
                </a>
              </li>
              @endcan
              @can('donations')
              <li class="@if(request()->path() == 'admin/donations/payment-log') active @endif">
                <a href="{{route('admin.donation.payment.log') . '?language=' . $default->code}}">
                <span class="sub-item">Donations</span>
                </a>
              </li>
              @endcan
              @can('report-donation')
              <li class="@if(request()->path() == 'admin/donation/report') active @endif">
                <a href="{{route('admin.donation.report')}}">
                <span class="sub-item">Report</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany



        {{-- Knowledgebase --}}
      @canany(['categories-acknowledged', 'articles'])
        {{-- Articles --}}
        <li class="nav-item
          @if(request()->path() == 'admin/article_categories') active
          @elseif(request()->path() == 'admin/articles') active
          @elseif(request()->path() == 'admin/article/archives') active
          @elseif(request()->is('admin/article/*/edit')) active
          @endif">
          <a data-toggle="collapse" href="#article">
            <i class='fas fa-pencil-alt'></i>
            <p>Knowledgebase</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/article_categories') show
            @elseif(request()->path() == 'admin/articles') show
            @elseif(request()->path() == 'admin/article/archives') show
            @elseif(request()->is('admin/article/*/edit')) show
            @endif" id="article">
            <ul class="nav nav-collapse">
              @can('categories-acknowledged')
              <li class="@if(request()->path() == 'admin/article_categories') active @endif">
                <a href="{{route('admin.article_category.index') . '?language=' . $default->code}}">
                <span class="sub-item">Category</span>
                </a>
              </li>
              @endcan
              @can('articles')
              <li class="@if(request()->path() == 'admin/articles') active
                @elseif(request()->is('admin/articles/*/edit')) active
                @endif">
                <a href="{{route('admin.article.index') . '?language=' . $default->code}}">
                <span class="sub-item">Articles</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany



        @canany(['settings-tickets', 'all-tickets', 'pending-tickets','open-tickets','close-tickets'])
        {{-- Tickets --}}
        <li class="nav-item
          @if(request()->path() == 'admin/all/tickets') active
          @elseif(request()->path() == 'admin/pending/tickets') active
          @elseif(request()->path() == 'admin/open/tickets') active
          @elseif(request()->path() == 'admin/closed/tickets') active
          @elseif(request()->routeIs('admin.ticket.messages')) active
          @elseif(request()->routeIs('admin.ticket.settings')) active
          @endif">
          <a data-toggle="collapse" href="#tickets">
            <i class="la flaticon-web-1"></i>
            <p>Support Tickets</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/all/tickets') show
            @elseif(request()->path() == 'admin/pending/tickets') show
            @elseif(request()->path() == 'admin/open/tickets') show
            @elseif(request()->path() == 'admin/closed/tickets') show
            @elseif(request()->routeIs('admin.ticket.messages')) show
            @elseif(request()->routeIs('admin.ticket.settings')) show
            @endif" id="tickets">
            <ul class="nav nav-collapse">
              @can('settings-tickets')
              <li class="@if(request()->path() == 'admin/ticket/settings') active @endif">
                <a href="{{route('admin.ticket.settings')}}">
                <span class="sub-item">Settings</span>
                </a>
              </li>
              @endcan
              @can('all-tickets')
              <li class="@if(request()->path() == 'admin/all/tickets') active @endif">
                <a href="{{route('admin.tickets.all')}}">
                <span class="sub-item">All Tickets</span>
                </a>
              </li>
              @endcan
              @can('pending-tickets')
              <li class="@if(request()->path() == 'admin/pending/tickets') active @endif">
                <a href="{{route('admin.tickets.pending')}}">
                <span class="sub-item">Pending Tickets</span>
                </a>
              </li>
              @endcan
              @can('open-tickets')
              <li class="@if(request()->path() == 'admin/open/tickets') active @endif">
                <a href="{{route('admin.tickets.open')}}">
                <span class="sub-item">Open Tickets</span>
                </a>
              </li>
              @endcan
              @can('close-tickets')
              <li class="@if(request()->path() == 'admin/closed/tickets') active @endif">
                <a href="{{route('admin.tickets.closed')}}">
                <span class="sub-item">Closed Tickets</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany

        
        @canany(['import-rss', 'rss-feeds', 'rss-posts'])
        {{-- RSS --}}
        <li class="nav-item
          @if(request()->path() == 'admin/rss/create') active
          @elseif(request()->path() == 'admin/rss/feeds') active
          @elseif(request()->path() == 'admin/rss') active
          @elseif(request()->is('admin/rss/edit/*')) active
          @endif">
          <a data-toggle="collapse" href="#rss">
            <i class="fa fa-rss"></i>
            <p>RSS Feeds</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/rss/create') show
            @elseif(request()->path() == 'admin/rss/feeds') show
            @elseif(request()->path() == 'admin/rss') show
            @elseif(request()->is('admin/rss/edit/*')) show
            @endif" id="rss">
            <ul class="nav nav-collapse">
              @can('import-rss')
              <li class="@if(request()->path() == 'admin/rss/create') active @endif">
                <a href="{{route('admin.rss.create')}}">
                <span class="sub-item">Import RSS Feeds</span>
                </a>
              </li>
              @endcan
              @can('rss-feeds')
              <li class="@if(request()->path() == 'admin/rss/feeds') active @endif">
                <a href="{{route('admin.rss.feed'). '?language=' . $default->code}}">
                <span class="sub-item">RSS Feeds</span>
                </a>
              </li>
              @endcan
              @can('rss-posts')
              <li class="@if(request()->path() == 'admin/rss') active @endif">
                <a href="{{route('admin.rss.index'). '?language=' . $default->code}}">
                <span class="sub-item">RSS Posts</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany


        {{-- Users Management --}}
       @canany(['register-users', 'push-notification', 'subscribers'])
        <li class="nav-item
          @if(request()->routeIs('admin.register.user')) active
          @elseif(request()->routeIs('register.user.view')) active
          @elseif(request()->routeIs('register.user.changePass')) active
          @elseif(request()->path() == 'admin/pushnotification/settings') active
          @elseif(request()->path() == 'admin/pushnotification/send') active
          @elseif(request()->path() == 'admin/subscribers') active
          @elseif(request()->path() == 'admin/mailsubscriber') active
          @endif">
          <a data-toggle="collapse" href="#usersManagement">
            <i class="la flaticon-users"></i>
            <p>Users Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->routeIs('admin.register.user')) show
            @elseif(request()->routeIs('register.user.view')) show
            @elseif(request()->routeIs('register.user.changePass')) show
            @elseif(request()->path() == 'admin/pushnotification/settings') show
            @elseif(request()->path() == 'admin/pushnotification/send') show
            @elseif(request()->path() == 'admin/subscribers') show
            @elseif(request()->path() == 'admin/mailsubscriber') show
            @endif" id="usersManagement">
            <ul class="nav nav-collapse">
              {{-- Registered Users --}}
              @can('register-users')
              <li class="
                @if(request()->routeIs('admin.register.user')) active
                @elseif(request()->routeIs('register.user.view')) active
                @elseif(request()->routeIs('register.user.changePass')) active
                @endif">
                <a href="{{route('admin.register.user')}}">
                <span class="sub-item">Registered Users</span>
                </a>
              </li>
              @endcan
              {{-- Push Notification --}}
              @can('push-notification')
              <li class="
                @if(request()->path() == 'admin/pushnotification/settings') selected
                @elseif(request()->path() == 'admin/pushnotification/send') selected
                @endif">
                <a data-toggle="collapse" href="#pushNotification">
                <span class="sub-item">Push Notification</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->path() == 'admin/pushnotification/settings') show
                  @elseif(request()->path() == 'admin/pushnotification/send') show
                  @endif" id="pushNotification">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->path() == 'admin/pushnotification/settings') active @endif">
                      <a href="{{route('admin.pushnotification.settings')}}">
                      <span class="sub-item">Settings</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/pushnotification/send') active @endif">
                      <a href="{{route('admin.pushnotification.send')}}">
                      <span class="sub-item">Send Notification</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
              {{-- Subscribers --}}
              @can('subscribers')
              <li class="
                @if(request()->path() == 'admin/subscribers') selected
                @elseif(request()->path() == 'admin/mailsubscriber') selected
                @endif">
                <a data-toggle="collapse" href="#subscribers">
                <span class="sub-item">Subscribers</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->path() == 'admin/subscribers') show
                  @elseif(request()->path() == 'admin/mailsubscriber') show
                  @endif" id="subscribers">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->path() == 'admin/subscribers') active @endif">
                      <a href="{{route('admin.subscriber.index')}}">
                      <span class="sub-item">Subscribers</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/mailsubscriber') active @endif">
                      <a href="{{route('admin.mailsubscriber')}}">
                      <span class="sub-item">Mail to Subscribers</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany


        {{-- Announcement Popup--}}
        @can('popups')
    
        <li class="nav-item
          @if(request()->path() == 'admin/popup/create') active
          @elseif(request()->path() == 'admin/popup/types') active
          @elseif(request()->is('admin/popup/*/edit')) active
          @elseif(request()->path() == 'admin/popups') active
          @endif">
          <a data-toggle="collapse" href="#announcementPopup">
            <i class="fas fa-bullhorn"></i>
            <p>Announcement Popup</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/popup/create') show
            @elseif(request()->path() == 'admin/popup/types') show
            @elseif(request()->path() == 'admin/popups') show
            @elseif(request()->is('admin/popup/*/edit')) show
            @endif" id="announcementPopup">
            <ul class="nav nav-collapse">
              <li class="@if(request()->path() == 'admin/popup/types') active
                @elseif(request()->path() == 'admin/popup/create') active
                @endif">
                <a href="{{route('admin.popup.types')}}">
                <span class="sub-item">Add Popup</span>
                </a>
              </li>
              
              <li class="@if(request()->path() == 'admin/popups') active
                @elseif(request()->is('admin/popup/*/edit')) active
                @endif">
                <a href="{{route('admin.popup.index') . '?language=' . $default->code}}">
                <span class="sub-item">Popups</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endcan
  


        @canany(['general-settings', 'file-manager', 'logo-text-header','preloader','preferences','support-information','social-links','page-headings','language','payment-gateways','email-settings','plugins','seo-information','maintenance-mode','cookies-alert','misc'])
        {{-- Basic Settings --}}
        <li class="nav-item
          @if(request()->path() == 'admin/logo') active
          @elseif(request()->path() == 'admin/file-manager') active
          @elseif(request()->path() == 'admin/preloader') active
          @elseif(request()->path() == 'admin/basicinfo') active
          @elseif(request()->path() == 'admin/support') active
          @elseif(request()->path() == 'admin/social') active
          @elseif(request()->is('admin/social/*')) active
          @elseif(request()->path() == 'admin/heading') active
          @elseif(request()->path() == 'admin/script') active
          @elseif(request()->path() == 'admin/seo') active
          @elseif(request()->path() == 'admin/maintainance') active
          @elseif(request()->path() == 'admin/cookie-alert') active
          @elseif(request()->path() == 'admin/mail-from-admin') active
          @elseif(request()->path() == 'admin/mail-to-admin') active
          @elseif(request()->routeIs('admin.featuresettings')) active
          @elseif(request()->path() == 'admin/email-templates') active
          @elseif(request()->routeIs('admin.email.editTemplate')) active
          @elseif(request()->path() == 'admin/languages') active
          @elseif(request()->is('admin/language/*/edit')) active
          @elseif(request()->is('admin/language/*/edit/keyword')) active
          @elseif(request()->path() == 'admin/gateways') active
          @elseif(request()->path() == 'admin/offline/gateways') active
          @elseif(request()->path() == 'admin/backup') active
          @elseif(request()->path() == 'admin/sitemap') active
          @endif">
          <a data-toggle="collapse" href="#basic">
            <i class="la flaticon-settings"></i>
            <p>Settings</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/logo') show
            @elseif(request()->path() == 'admin/file-manager') show
            @elseif(request()->path() == 'admin/preloader') show
            @elseif(request()->path() == 'admin/basicinfo') show
            @elseif(request()->path() == 'admin/support') show
            @elseif(request()->path() == 'admin/social') show
            @elseif(request()->is('admin/social/*')) show
            @elseif(request()->path() == 'admin/heading') show
            @elseif(request()->path() == 'admin/script') show
            @elseif(request()->path() == 'admin/seo') show
            @elseif(request()->path() == 'admin/maintainance') show
            @elseif(request()->path() == 'admin/cookie-alert') show
            @elseif(request()->path() == 'admin/mail-from-admin') show
            @elseif(request()->path() == 'admin/mail-to-admin') show
            @elseif(request()->routeIs('admin.featuresettings')) show
            @elseif(request()->path() == 'admin/email-templates') show
            @elseif(request()->routeIs('admin.email.editTemplate')) show
            @elseif(request()->path() == 'admin/languages') show
            @elseif(request()->is('admin/language/*/edit')) show
            @elseif(request()->is('admin/language/*/edit/keyword')) show
            @elseif(request()->path() == 'admin/gateways') show
            @elseif(request()->path() == 'admin/offline/gateways') show
            @elseif(request()->path() == 'admin/backup') show
            @elseif(request()->path() == 'admin/sitemap') show
            @endif" id="basic">
            <ul class="nav nav-collapse">
              @can('general-settings')
              <li class="@if(request()->path() == 'admin/basicinfo') active @endif">
                <a href="{{route('admin.basicinfo')}}">
                <span class="sub-item">General Settings</span>
                </a>
              </li>
              @endcan
              @can('email-settings')
              <li class="submenu">
                <a data-toggle="collapse" href="#emailset" aria-expanded="{{(request()->path() == 'admin/mail-from-admin' || request()->path() == 'admin/mail-to-admin' || request()->path() == 'admin/email-templates' || request()->routeIs('admin.email.editTemplate')) ? 'true' : 'false' }}">
                <span class="sub-item">Email Settings</span>
                <span class="caret"></span>
                </a>
                <div class="collapse {{(request()->path() == 'admin/mail-from-admin' || request()->path() == 'admin/mail-to-admin' || request()->path() == 'admin/email-templates' || request()->routeIs('admin.email.editTemplate')) ? 'show' : '' }}" id="emailset" style="">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->path() == 'admin/mail-from-admin') active @endif">
                      <a href="{{route('admin.mailFromAdmin')}}">
                      <span class="sub-item">Mail from Admin</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/mail-to-admin') active @endif">
                      <a href="{{route('admin.mailToAdmin')}}">
                      <span class="sub-item">Mail to Admin</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/email-templates') active
                      @elseif(request()->routeIs('admin.email.editTemplate')) active
                      @endif">
                      <a href="{{route('admin.email.templates')}}">
                      <span class="sub-item">Email Templates</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
              @can('file-manager')
              <li class="@if(request()->path() == 'admin/file-manager') active @endif">
                <a href="{{route('admin.file-manager')}}">
                <span class="sub-item">File Manager</span>
                </a>
              </li>
              @endcan
              @can('logo-text-header')
              <li class="@if(request()->path() == 'admin/logo') active @endif">
                <a href="{{route('admin.logo')}}">
                <span class="sub-item">Logo & Images</span>
                </a>
              </li>
              @endcan
              @can('preloader')
              <li class="@if(request()->path() == 'admin/preloader') active @endif">
                <a href="{{route('admin.preloader')}}">
                <span class="sub-item">Preloader</span>
                </a>
              </li>
              @endcan
              @can('preferences')
              <li class="@if(request()->routeIs('admin.featuresettings')) active @endif">
                <a href="{{route('admin.featuresettings') . '?language=' . $default->code}}">
                <span class="sub-item">Preferences</span>
                </a>
              </li>
              @endcan
              @can('support-information')
              <li class="@if(request()->path() == 'admin/support') active @endif">
                <a href="{{route('admin.support') . '?language=' . $default->code}}">
                <span class="sub-item">Support Informations</span>
                </a>
              </li>
              @endcan
              @can('social-links')
              <li class="@if(request()->path() == 'admin/social') active
                @elseif(request()->is('admin/social/*')) active @endif">
                <a href="{{route('admin.social.index')}}">
                <span class="sub-item">Social Links</span>
                </a>
              </li>
              @endcan
              @can('page-headings')
              <li class="@if(request()->path() == 'admin/heading') active @endif">
                <a href="{{route('admin.heading') . '?language=' . $default->code}}">
                <span class="sub-item">Page Headings</span>
                </a>
              </li>
              @endcan
              @can('payment-gateways')
              <li class="
                @if(request()->path() == 'admin/gateways') selected
                @elseif(request()->path() == 'admin/offline/gateways') selected
                @endif">
                <a data-toggle="collapse" href="#gateways">
                <span class="sub-item">Payment Gateways</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->path() == 'admin/gateways') show
                  @elseif(request()->path() == 'admin/offline/gateways') show
                  @endif" id="gateways">
                  <ul class="nav nav-collapse subnav">
                    <li class="@if(request()->path() == 'admin/gateways') active @endif">
                      <a href="{{route('admin.gateway.index')}}">
                      <span class="sub-item">Online Gateways</span>
                      </a>
                    </li>
                    <li class="@if(request()->path() == 'admin/offline/gateways') active @endif">
                      <a href="{{route('admin.gateway.offline') . '?language=' . $default->code}}">
                      <span class="sub-item">Offline Gateways</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
              @can('language')
              <li class="
                @if(request()->path() == 'admin/languages') active
                @elseif(request()->is('admin/language/*/edit')) active
                @elseif(request()->is('admin/language/*/edit/keyword')) active
                @endif">
                <a href="{{route('admin.language.index')}}">
                <span class="sub-item">Language</span>
                </a>
              </li>
              @endcan
              @can('plugins')
              <li class="@if(request()->path() == 'admin/script') active @endif">
                <a href="{{route('admin.script')}}">
                <span class="sub-item">Plugins</span>
                </a>
              </li>
              @endcan
              @can('seo-information')
              <li class="@if(request()->path() == 'admin/seo') active @endif">
                <a href="{{route('admin.seo') . '?language=' . $default->code}}">
                <span class="sub-item">SEO Information</span>
                </a>
              </li>
              @endcan
              @can('maintenance-mode')
              <li class="@if(request()->path() == 'admin/maintainance') active @endif">
                <a href="{{route('admin.maintainance')}}">
                <span class="sub-item">Maintenance Mode</span>
                </a>
              </li>
              @endcan
              @can('cookies-alert')
              <li class="@if(request()->path() == 'admin/cookie-alert') active @endif">
                <a href="{{route('admin.cookie.alert') . '?language=' . $default->code}}">
                <span class="sub-item">Cookie Alert</span>
                </a>
              </li>
              @endcan
              @can('misc')
              <li class="
                @if(request()->path() == 'admin/backup') selected
                @elseif(request()->path() == 'admin/sitemap') selected
                @endif">
                <a data-toggle="collapse" href="#misc">
                <span class="sub-item">MISC</span>
                <span class="caret"></span>
                </a>
                <div class="collapse
                  @if(request()->path() == 'admin/backup') show
                  @elseif(request()->path() == 'admin/sitemap') show
                  @endif" id="misc">
                  <ul class="nav nav-collapse subnav">
                    <li class="
                      @if(request()->path() == 'admin/sitemap') selected
                      @endif">
                      <a href="{{route('admin.sitemap.index') . '?language=' . $default->code}}">
                      <span class="sub-item">Sitemap</span>
                      </a>
                    </li>
                    <li class="
                      @if(request()->path() == 'admin/backup') selected
                      @endif">
                      <a href="{{route('admin.backup.index')}}">
                      <span class="sub-item">Database Backup</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{route('admin.cache.clear')}}">
                      <span class="sub-item">Clear Cache</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany


      @canany(['admins', 'roles'])
        {{-- Admins Management --}}
        <li class="nav-item
          @if(request()->path() == 'admin/roles') active
          @elseif(request()->is('admin/role/*/permissions/manage')) active
          @elseif(request()->path() == 'admin/users') active
          @elseif(request()->is('admin/user/*/edit')) active
          @endif">
          <a data-toggle="collapse" href="#adminsManagement">
            <i class="fas fa-users-cog"></i>
            <p>Admins Management</p>
            <span class="caret"></span>
          </a>
          <div class="collapse
            @if(request()->path() == 'admin/roles') show
            @elseif(request()->is('admin/role/*/permissions/manage')) show
            @elseif(request()->path() == 'admin/users') show
            @elseif(request()->is('admin/user/*/edit')) show
            @endif" id="adminsManagement">
            <ul class="nav nav-collapse">
              @can('roles')
              <li class="
                @if(request()->path() == 'admin/roles') active
                @elseif(request()->is('admin/role/*/permissions/manage')) active
                @endif">
                <a href="{{route('admin.role.index')}}">
                <span class="sub-item">Role Management</span>
                </a>
              </li>
              @endcan
              @can('admins')
              <li class="
                @if(request()->path() == 'admin/users') active
                @elseif(request()->is('admin/user/*/edit')) active
                @endif">
                <a href="{{route('admin.user.index')}}">
                <span class="sub-item">Admins</span>
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </li>
        @endcanany
  
        {{-- Client Feedbacks --}}
        @can('admin')
        <li class="nav-item @if(request()->path() == 'admin/feedbacks') active @endif">
          <a href="{{route('admin.client_feedbacks')}}">
            <i class="fas fa-pen-fancy"></i>
            <p>Client Feedbacks</p>
          </a>
        </li>
        @endcan
  
        {{-- @can('audit-trail')

        <li class="nav-item">
          <a href="javascript:void(0)">
            <i class="fas fa-pen-fancy"></i>
            <p>Audit Trail</p>
          </a>
        </li>
        @endcan
      </ul> --}}

      @can('audit-trail')
      {{-- Dashboard --}}
      <li class="nav-item">
        <a href="{{route('audit-from')}}">
          <i class="la flaticon-paint-palette"></i>
          <p>Audit Trail</p>
        </a>
      </li>
      @endcan

    </div>
  </div>
</div>