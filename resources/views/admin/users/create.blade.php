@extends('layouts.index')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">إضافة طلب</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">الرئيسية</a>
                        </li>
                        <!--end::Item-->


                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">الطلبات</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">إضاقة طلب</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
												<path
                                                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                    fill="currentColor"/>
											</svg>
										</span>
                            <!--end::Svg Icon-->Filter</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                             id="kt_menu_624475d8f2177">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                                data-placeholder="Select option"
                                                data-dropdown-parent="#kt_menu_624475d8f2177" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1"/>
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                   checked="checked"/>
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications"
                                               checked="checked"/>
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                            data-kt-menu-dismiss="true">Reset
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">
                                        Apply
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                       data-bs-target="#kt_modal_create_app">Create</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <form action="{{route('order.store')}}" method="post" class="form d-flex flex-column flex-lg-row"
                      data-kt-redirect="../../demo1/dist/apps/ecommerce/sales/listing.html">
                    @csrf

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">

                        <!--begin::Order details-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            {{--                            <div class="card-header">--}}
                            {{--                                <div class="card-title">--}}
                            {{--                                    <h2>تفاصيل الطلب</h2>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Billing address-->
                                <div class="d-flex flex-column gap-5 gap-md-7">
                                    <!--begin::Title-->
                                    <div class="fs-3 fw-bolder mb-n2">تفاصيل الطلب</div>
                                    <!--end::Title-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">الإسم</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input required class="form-control" name="name"
                                                   placeholder="أضف الإسم" value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">رقم الفاتورة</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control" name="invoice_num"
                                                   placeholder="أدخل رقم الفاتور"/>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row">

                                        <!--begin::Label-->
                                        <label class="required form-label">الدولة</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <div class="form-floating border rounded">
                                            <select class="form-select" data-placeholder="Select an option"
                                                    id="kt_ecommerce_edit_order_billing_country"
                                                    name="country_id">
                                                <option></option>
                                                <option value="1"
                                                        data-kt-select2-country="assets/media/flags/yemen.svg">Yemen
                                                </option>
                                                <option value="2"
                                                        data-kt-select2-country="assets/media/flags/zambia.svg">Zambia
                                                </option>
                                                <option value="3"
                                                        data-kt-select2-country="assets/media/flags/zimbabwe.svg">
                                                    Zimbabwe
                                                </option>
                                            </select>
                                            <label for="kt_ecommerce_edit_order_billing_country">اختر الدولة</label>
                                        </div>
                                        <!--end::Select2-->
                                    </div>
                                    <!--end::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">المدينة</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control" name="city_id" placeholder=""
                                                   value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">الكمبة</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control" name="amount"
                                                   placeholder="أدخل الكمبة"
                                                   value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">السعر</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control" name="price" placeholder=""
                                                   value=""/>
                                            <!--end::Input-->
                                        </div>

                                    </div>
                                    <!--end::Input group-->
                                    <div class="d-flex flex-column flex-md-row gap-5">
                                        <div class="flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="form-label">العنوان</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control" name="address" placeholder=""
                                                   value=""/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">حالة التسليم</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select" data-placeholder="Select an option"
                                                    id="kt_ecommerce_edit_order_billing_country"
                                                    name="delivery_status">
                                                <option value="تم التسليم"
                                                        data-kt-select2-country="assets/media/flags/afghanistan.svg">
                                                    تم التسليم
                                                </option>
                                                <option value="مرجع"
                                                        data-kt-select2-country="assets/media/flags/afghanistan.svg">
                                                    مرجع
                                                </option>
                                            </select>

                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row flex-row-fluid">
                                            <!--begin::Label-->
                                            <label class="required form-label">المحاسبة</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="accounting" class="form-control form-control" placeholder="Pick date rage" id="kt_daterangepicker_3"/>

                                            <!--end::Input-->
                                        </div>
{{--                                        <div class="form-check form-switch form-check-custom form-check-solid">--}}
{{--                                            <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault"/>--}}
{{--                                            <label class="form-check-label" for="flexSwitchDefault">--}}
{{--                                                Default switch--}}
{{--                                            </label>--}}
{{--                                        </div>--}}

                                    </div>



{{--                                    <!--begin::Checkbox-->--}}
{{--                                    <div class="form-check form-check-custom form-check-solid">--}}
{{--                                        <input class="form-check-input" type="checkbox" value="" id="same_as_billing"--}}
{{--                                               checked="checked"/>--}}
{{--                                        <label class="form-check-label" for="same_as_billing">Shipping address is the--}}
{{--                                            same as billing address</label>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Checkbox-->--}}
                                    <!--begin::Shipping address-->
                                    <div class="d-none d-flex flex-column gap-5 gap-md-7"
                                         id="kt_ecommerce_edit_order_shipping_form">
                                        <!--begin::Title-->
                                        <div class="fs-3 fw-bolder mb-n2">Shipping Address</div>
                                        <!--end::Title-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">Address Line 1</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control" name="kt_ecommerce_edit_order_address_1"
                                                       placeholder="Address Line 1" value=""/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">Address Line 2</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control" name="kt_ecommerce_edit_order_address_2"
                                                       placeholder="Address Line 2"/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column flex-md-row gap-5">
                                            <div class="flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">City</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control" name="kt_ecommerce_edit_order_city"
                                                       placeholder="" value=""/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">Postcode</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control" name="kt_ecommerce_edit_order_postcode"
                                                       placeholder="" value=""/>
                                                <!--end::Input-->
                                            </div>
                                            <div class="fv-row flex-row-fluid">
                                                <!--begin::Label-->
                                                <label class="form-label">State</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control" name="kt_ecommerce_edit_order_state"
                                                       placeholder="" value=""/>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">الدولة</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                            <div class="form-floating border rounded">
                                                <select class="form-select" data-placeholder="Select an option"
                                                        id="kt_ecommerce_edit_order_shipping_country">
                                                    <option></option>
                                                    <option value="ZW"
                                                            data-kt-select2-country="assets/media/flags/zimbabwe.svg">
                                                        فلسطين
                                                    </option>
                                                    <option value="ZW"
                                                            data-kt-select2-country="assets/media/flags/zimbabwe.svg">
                                                        القدس
                                                    </option>
                                                </select>
                                                <label for="kt_ecommerce_edit_order_shipping_country">Select a
                                                    country</label>
                                            </div>
                                            <!--end::Select2-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Shipping address-->
                                </div>
                                <!--end::Billing address-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Order details-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="../../demo1/dist/apps/ecommerce/catalog/products.html"
                               id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection
