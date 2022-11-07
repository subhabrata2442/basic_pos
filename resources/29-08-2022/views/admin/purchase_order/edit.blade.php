@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post"
                    action="{{ route('admin.stock.purchase-order.edit', [base64_encode($data['purchase_order']->id)]) }}"
                    class="needs-validation" id="purchase_order_form" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-alert />
                        <div class="col-md-12">
                            <div class="order-input-box">
                                <div class="row">
                                    <div class="order-input-box-head">
                                        <h4>supplier detail</h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="supplier_code" class="form-label">Supplier Code</label>
                                            <select id="supplier_code" name="supplier_code"
                                                class="form-control admin-input">
                                                <option value="">-- Select --</option>
                                                @foreach ($data['supplier'] as $key => $value)
                                                    <option value="{{ $value->id }}"
                                                        data-sup_name="{{ $value->sup_name }}"
                                                        @if ($data['purchase_order']->supplier_id == $value->id) selected @endif>
                                                        {{ $value->sup_code }}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_code')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="supplier_name" class="form-label">Supplier Name</label>
                                            <input type="text" class="form-control admin-input" id="supplier_name"
                                                name="supplier_name"
                                                value="{{ old('supplier_name', $data['purchase_order']->supplier_dtl->sup_name) }}"
                                                required readonly autocomplete="off">
                                            @error('supplier_name')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="supplier_ref" class="form-label">Supplier Reference</label>
                                            <input type="text" class="form-control admin-input" id="supplier_ref"
                                                name="supplier_ref"
                                                value="{{ old('supplier_ref', $data['purchase_order']->supplier_ref) }}"
                                                autocomplete="off">
                                            @error('supplier_ref')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="order-input-box">
                                <div class="row">
                                    <div class="order-input-box-head">
                                        <h4> delivery detail</h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivery_name" class="form-label">Delivery Name</label>
                                            <input type="text" class="form-control admin-input" id="delivery_name"
                                                name="delivery_name"
                                                value="{{ old('delivery_name', $data['purchase_order']->delivery_name) }}"
                                                required autocomplete="off">
                                            @error('delivery_name')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="address_line_1" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control admin-input" id="address_line_1"
                                                name="address_line_1"
                                                value="{{ old('address_line_1', $data['purchase_order']->address_one) }}"
                                                required autocomplete="off">
                                            @error('address_line_1')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="address_line_2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control admin-input" id="address_line_2"
                                                name="address_line_2"
                                                value="{{ old('address_line_2', $data['purchase_order']->address_two) }}"
                                                required autocomplete="off">
                                            @error('address_line_2')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control admin-input" id="city" name="city"
                                                value="{{ old('city', $data['purchase_order']->city) }}" required
                                                autocomplete="off">
                                            @error('city')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control admin-input" id="state" name="state"
                                                value="{{ old('state', $data['purchase_order']->state) }}" required
                                                autocomplete="off">
                                            @error('state')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="post_code" class="form-label">Post Code</label>
                                            <input type="text" class="form-control admin-input" id="post_code"
                                                name="post_code"
                                                value="{{ old('post_code', $data['purchase_order']->post_code) }}"
                                                required autocomplete="off">
                                            @error('post_code')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="order-input-box">
                                <div class="row">
                                    <div class="order-input-box-head">
                                        <h4>Purchase Order detail</h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="order_date" class="form-label">Order Date</label>
                                            <input type="date" class="form-control admin-input" id="order_date"
                                                name="order_date"
                                                value="{{ old('order_date', $data['purchase_order']->order_date) }}"
                                                required autocomplete="off">
                                            @error('order_date')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivery_date" class="form-label">Delivery Date</label>
                                            <input type="date" class="form-control admin-input" id="delivery_date"
                                                name="delivery_date"
                                                value="{{ old('delivery_date', $data['purchase_order']->delivery_date) }}"
                                                required autocomplete="off">
                                            @error('delivery_date')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivery_charge" class="form-label">Delivery Charge</label>
                                            <input type="text" class="form-control admin-input" id="delivery_charge"
                                                name="delivery_charge"
                                                value="{{ old('delivery_charge', $data['purchase_order']->delivery_charge) }}"
                                                autocomplete="off">
                                            @error('delivery_charge')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="nav-list-wrap mt-3">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">Order Lines</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="suppliers-table table-responsive">
                                        <table class="table text-nowrap bt-none">
                                            <thead>
                                                <tr>
                                                    <th style="width: 14%">Product</th>
                                                    <th>Qty</th>
                                                    <th style="width: 14%">Price</th>
                                                    <th>Discount (%)</th>
                                                    <th>Availibility</th>
                                                    <th>Sub Total</th>
                                                    <th>Comments</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="select-two">
                                                            <select id="product_id" class="form-control admin-input">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($data['product'] as $key => $value)
                                                                    <option value="{{ $value->id }}"
                                                                        data-product_desc="{{ $value->product_desc }}">
                                                                        {{ $value->product_code }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="number" id="product_qty"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="number" id="product_price"
                                                            class="form-control admin-input" readonly>
                                                    </td>
                                                    <td><input type="number" id="product_discount"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="number" id="product_availibility"
                                                            class="form-control admin-input" readonly>
                                                    </td>
                                                    <td><input type="number" id="product_sub_total"
                                                            class="form-control admin-input" readonly>
                                                    </td>
                                                    <td><input type="text" id="product_comment"
                                                            class="form-control admin-input">
                                                    </td>

                                                    <td>
                                                        <input type="hidden" id="supplier_product_code">
                                                        <input type="hidden" id="product_desc">
                                                        <input type="hidden" id="product_purchase_tax_rate">
                                                        <input type="hidden" id="product_purchase_tax_amt">
                                                        <input type="hidden" id="product_purchase_disc_amt">
                                                        <div class="supplier-add">
                                                            <button type="button"
                                                                class="btn btn-success btn-sm addProductPurchase"><i
                                                                    class="fas fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table text-nowrap thead-bg" id="product_table">
                                            <thead>
                                                <tr>
                                                    <th>Product Code</th>
                                                    {{-- <th>Supplier Product Code</th> --}}
                                                    <th>Product Desc</th>
                                                    <th>Price</th>
                                                    <th>Qty.</th>
                                                    <th>Discount (%)</th>
                                                    <th>Disc. Price</th>
                                                    <th>Tax Rate (%)</th>
                                                    <th>Total</th>
                                                    <th>Comments</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $item_count = 0;
                                                    $purchase_product_total = 0;
                                                    $costing_sub_total = 0;
                                                @endphp
                                                @foreach ($data['purchase_order']->purchase_product as $item)
                                                    @php
                                                        $item_count += $item->qty;
                                                        $purchase_product_total += $item->total;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{ $item->product_dtl->product_code }}
                                                            <input type="hidden" name="product_id[]"
                                                                value="{{ $item->product_id }}" class="product_id">
                                                        </td>
                                                        {{-- <td>
                                                            ${supplier_product_code}
                                                            <input type="hidden" name="supplier_product_code[]"
                                                                value="${supplier_product_code}"
                                                                class="supplier_product_code">
                                                        </td> --}}
                                                        <td>
                                                            {{ $item->product_dtl->product_desc }}
                                                            <input type="hidden" name="product_desc[]"
                                                                value="{{ $item->product_dtl->product_desc }}"
                                                                class="product_desc">
                                                        </td>
                                                        <td>
                                                            {{ $item->price }}
                                                            <input type="hidden" name="product_price[]"
                                                                value="{{ $item->price }}" class="product_price">
                                                        </td>
                                                        <td>
                                                            {{ $item->qty }}
                                                            <input type="hidden" name="product_qty[]"
                                                                value="{{ $item->qty }}" class="product_qty">
                                                        </td>
                                                        <td>
                                                            {{ $item->discount }}
                                                            <input type="hidden" name="product_discount[]"
                                                                value="{{ $item->discount }}" class="product_discount">
                                                        </td>
                                                        <td>
                                                            {{ ($item->price * $item->qty * $item->discount) / 100 }}
                                                            <input type="hidden" name="product_purchase_disc_amt[]"
                                                                value="{{ ($item->price * $item->qty * $item->discount) / 100 }}"
                                                                class="product_purchase_disc_amt">
                                                        </td>
                                                        <td>
                                                            {{ $item->tax_rate }}
                                                            <input type="hidden" name="product_purchase_tax_rate[]"
                                                                value="{{ $item->tax_rate }}"
                                                                class="product_purchase_tax_rate">
                                                        </td>
                                                        <td>
                                                            {{ $item->total }}
                                                            <input type="hidden" name="product_sub_total[]"
                                                                value="{{ $item->total }}" class="product_sub_total">
                                                        </td>
                                                        <td>
                                                            {{ $item->comments }}
                                                            <input type="hidden" name="product_comment[]"
                                                                value="{{ $item->comments }}" class="product_comment">
                                                        </td>
                                                        <td>
                                                            <div class="supplier-add">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-product-purchase-td"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="billing-wrap">
                                <div class="billing-wrap-head">
                                    <p>item count</p>
                                    <h4 id="item_count">{{ $item_count }}</h4>
                                    <input type="hidden" id="item_count_input" value="{{ $item_count }}">
                                    <p>sub total</p>
                                    <h4 id="purchase_product_total">{{ $purchase_product_total }}</h4>
                                    <input type="hidden" id="purchase_product_total_input"
                                        value="{{ $purchase_product_total }}">
                                    <p>Delivery charge</p>
                                    <h4 id="delivery_charge_total">{{ $data['purchase_order']->delivery_charge }}</h4>
                                </div>
                                <div class="billing-wrap-ftr">
                                    <p>total</p>
                                    <h4 id="sub_total">{{ $data['purchase_order']->sub_total }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row justify-content-between align-items-end">
                                <div class="col-auto"><button class="commonBtn-btnTag" type="submit">Submit
                                    </button></div>
                                <div class="col-auto">
                                    <div class="order-edit-btn-wrap">
                                        <ul class="d-flex">
                                            <li><button type="button" class="commonBtn-btnTag" data-bs-toggle="collapse"
                                                    data-bs-target="#emailLog" aria-expanded="false"
                                                    aria-controls="multiCollapseExample2"><i id="eyeIcon"
                                                        class="fas fa-eye"></i>view email log</button></li>
                                            <li><button type="button" class="commonBtn-btnTag"><i
                                                        class="fas fa-print"></i>print</button></li>
                                            <li><button type="button" class="commonBtn-btnTag" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop"><i
                                                        class="far fa-envelope"></i>email</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="emai-log-panal">
                            <div class="collapse multi-collapse" id="emailLog">
                                <div class="card">
                                    <div class="card-body">
                                        Some placeholder content for the first collapse component of this multi-collapse
                                        example. This panel is hidden by default but revealed when the user activates the
                                        relevant trigger.Some placeholder content for the first collapse component of this
                                        multi-collapse example. This panel is hidden by default but revealed when the user
                                        activates the relevant trigger.Some placeholder content for the first collapse
                                        component of this multi-collapse example. This panel is hidden by default but
                                        revealed when the user activates the relevant trigger.Some placeholder content for
                                        the first collapse component of this multi-collapse example. This panel is hidden by
                                        default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="purchaseOrder-emailmodal">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">send email</h5>
                        <button type="button" class="btn-close-mdl" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times-circle"></i></button>
                    </div>
                    <div class="modal-body email-wrap">
                        <div class="email-wrap-list d-flex">
                            <div class="email-wrap-lft">to</div>
                            <div class="email-wrap-rgt">
                                <div class="">
                                    <input type="text" id="to_email" name="to_email"
                                        value="{{ $data['purchase_order']->supplier_dtl->email }}" data-role="tagsinput"
                                        class="form-control admin-input">
                                </div>
                            </div>
                        </div>
                        <div class="email-wrap-list d-flex">
                            <div class="email-wrap-lft">cc</div>
                            <div class="email-wrap-rgt">
                                <div class="">
                                    <input type="text" id="cc_email" name="cc_email" data-role="tagsinput"
                                        class="form-control admin-input">
                                </div>
                            </div>
                        </div>
                        <div class="email-wrap-list d-flex">
                            <div class="email-wrap-lft">subject</div>
                            <div class="email-wrap-rgt">
                                <div class="">
                                    <input type="text" id="subject" name="subject" class="form-control admin-input"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="email-wrap-list d-flex">
                            <div class="email-wrap-lft">message</div>
                            <div class="email-wrap-rgt">
                                <div class="">
                                    <textarea rows="4" id="message" name="message" class="form-control admin-textarea"></textarea>
                                </div>
                                <div class="email-wrap-list-btm">
                                    <p>Separate multiple email address with comma(,)</p>
                                    <div class="checkbox">
                                        <input id="send_copy" type="checkbox" value="1" name="send_copy">
                                        <label for="send_copy">Send me a copy</label>
                                    </div>
                                    <button type="button" class="commonBtn-btnTag" id="send_email">send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).on("change", "#purchase_order_form #product_id", function() {
                let product_id = $(this).val();
                if (product_id != '') {
                    let supplier_id = $("#purchase_order_form #supplier_code").val() ?
                        $("#purchase_order_form #supplier_code").val() : 0;
                    let discount = $("#purchase_order_form #discount").val() ? $("#purchase_order_form #discount")
                        .val() :
                        0;
                    let data = {
                        product_id: product_id,
                        supplier_id: supplier_id,
                        _token: '{!! csrf_token() !!}'
                    };
                    $.ajax({
                        method: "POST",
                        url: "{{ route('admin.stock.purchase-order.productSupplierDtl') }}",
                        dataType: "json",
                        data: data,
                        success: function(response) {
                            $('#purchase_order_form #product_qty').val(response.data.qty);
                            $('#purchase_order_form #product_price').val(response.data.price);
                            $('#purchase_order_form #product_availibility').val(response.data.availibility);
                            $('#purchase_order_form #supplier_product_code').val(response.data
                                .supplier_product_code);
                            $('#purchase_order_form #product_desc').val(response.data.product_desc);
                            $('#purchase_order_form #product_discount').val(discount);
                            $('#purchase_order_form #product_purchase_tax_rate').val(response.data
                                .purchase_tax_rate);

                            let sub_total = 0;
                            let total = parseInt(response.data.qty) * parseFloat(response.data.price);
                            let discount_amt = total * parseFloat(discount) / 100;
                            let tax_amt = total * parseFloat(response.data.purchase_tax_rate) / 100;

                            sub_total = total + tax_amt - discount_amt;
                            sub_total = parseFloat(sub_total).toFixed(2);

                            $('#purchase_order_form #product_sub_total').val(sub_total);
                            $('#purchase_order_form #product_purchase_tax_amt').val(tax_amt);
                            $('#purchase_order_form #product_purchase_disc_amt').val(discount_amt);
                        },
                        error: function(e) {

                        }
                    });
                }

            });

            // $(document).on('click', '#send_email', function() {
            //     var to_email = $('#to_email').val();
            //     var subject = $('#subject').val();
            //     var message = $('#message').val();
            //     var cc_email = $('#cc_email').val();
            //     var send_copy = 0;

            //     if ($('#send_copy').is(':checked')) {
            //         send_copy = 1;
            //     }
            //     if (to_email == '') {
            //         toastr.error('To email field is required');
            //         return;
            //     }
            //     if (subject == '') {
            //         toastr.error('Subject field is required');
            //         return;
            //     }
            //     let data = {
            //         to_email: to_email,
            //         subject: subject,
            //         message: message,
            //         cc_email: cc_email,
            //         send_copy: send_copy,
            //         _token: '{!! csrf_token() !!}'
            //     };
            //     $.ajax({
            //         method: "POST",
            //         url: "{{ route('admin.stock.purchase-order.sendEmail') }}",
            //         dataType: "json",
            //         data: data,
            //         success: function(response) {
            //             console.log(response);
            //         }
            //     })
            // });
        </script>
    @endsection
