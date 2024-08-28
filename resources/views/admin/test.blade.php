<tbody class="fw-bold text-gray-600">
@foreach($orders as $order)
    <tr>
        <!--begin::Checkbox-->
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <!--end::Checkbox-->
        <!--begin::Name=-->
        <td>
            <a href="../../demo1/dist/apps/ecommerce/customers/details.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
        </td>
        <!--end::Name=-->
        <!--begin::Email=-->
        <td>
            <a href="#" class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
        </td>
        <!--end::Email=-->
        <!--begin::Status=-->
        <td>
            <!--begin::Badges-->
            <div class="badge badge-light-danger">Locked</div>
            <!--end::Badges-->
        </td>
        <!--end::Status=-->
        <!--begin::IP Address=-->
        <td>164.68.28.242</td>
        <!--end::IP Address=-->
        <!--begin::Date=-->
        <td>25 Jul 2022, 8:43 pm</td>
        <!--end::Date=-->
        <!--begin::Action=-->
        <td>25 Jul 2022, 8:43 pm</td>

        <td>25 Jul 2022, 8:43 pm</td>

        <td>25 Jul 2022, 8:43 pm</td>

        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
															</svg>
														</span>
                <!--end::Svg Icon--></a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
        <!--end::Action=-->
    </tr>
@endforeach

</tbody>
