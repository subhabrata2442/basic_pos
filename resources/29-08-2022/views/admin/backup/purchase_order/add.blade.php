@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="{{ route('admin.stock.purchase-order.add') }}" class="needs-validation"
                    id="purchase_order_form" novalidate enctype="multipart/form-data">
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
                                                        data-sup_name="{{ $value->sup_name }}">
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
                                                name="supplier_name" value="{{ old('supplier_name') }}" required readonly
                                                autocomplete="off">
                                            @error('supplier_name')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="supplier_ref" class="form-label">Supplier Reference</label>
                                            <input type="text" class="form-control admin-input" id="supplier_ref"
                                                name="supplier_ref" value="{{ old('supplier_ref') }}" autocomplete="off">
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
                                                name="delivery_name" value="{{ old('delivery_name') }}" required
                                                autocomplete="off">
                                            @error('delivery_name')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="address_line_1" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control admin-input" id="address_line_1"
                                                name="address_line_1" value="{{ old('address_line_1') }}" required
                                                autocomplete="off">
                                            @error('address_line_1')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="address_line_2" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control admin-input" id="address_line_2"
                                                name="address_line_2" value="{{ old('address_line_2') }}" required
                                                autocomplete="off">
                                            @error('address_line_2')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control admin-input" id="city" name="city"
                                                value="{{ old('city') }}" required autocomplete="off">
                                            @error('city')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control admin-input" id="state" name="state"
                                                value="{{ old('state') }}" required autocomplete="off">
                                            @error('state')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="post_code" class="form-label">Post Code</label>
                                            <input type="text" class="form-control admin-input" id="post_code"
                                                name="post_code" value="{{ old('post_code') }}" required
                                                autocomplete="off">
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
                                                name="order_date" value="{{ old('order_date') }}" required
                                                autocomplete="off">
                                            @error('order_date')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivery_date" class="form-label">Delivery Date</label>
                                            <input type="date" class="form-control admin-input" id="delivery_date"
                                                name="delivery_date" value="{{ old('delivery_date') }}" required
                                                autocomplete="off">
                                            @error('delivery_date')
                                                <div class="error admin-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivery_charge" class="form-label">Delivery Charge</label>
                                            <input type="text" class="form-control admin-input" id="delivery_charge"
                                                name="delivery_charge" value="{{ old('delivery_charge', 0) }}"
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
                                                            <select id="product_id" class="form-control admin-input"
                                                                disabled>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <div class="nav-list-wrap mt-3">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">Cost Lines</button>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="suppliers-table table-responsive">
                                        <table class="table text-nowrap bt-none">
                                            <thead>
                                                <tr>
                                                    <th style="width: 14%">Supplier</th>
                                                    <th>Cost</th>
                                                    <th>Taxable</th>
                                                    <th>Exchange Rate</th>
                                                    <th>Cost Date</th>
                                                    <th>Reference</th>
                                                    <th>Tax</th>
                                                    <th>Comments</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="select-two">
                                                            <select id="supp_code" class="form-control admin-input">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($data['supplier'] as $key => $value)
                                                                    <option value="{{ $value->id }}"
                                                                        data-sup_name="{{ $value->sup_name }}">
                                                                        {{ $value->sup_code }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" id="supp_name" class="form-control admin-input">
                                                    </td>
                                                    <td>
                                                        <div class="checkbox chk-style">
                                                            <input type="checkbox" checked name="supp_default[${i}]"
                                                                value="1" id="supp_default${i}" class="supp_default">
                                                            <label for="supp_default${i}"></label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" id="supp_product_desc"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="number" id="supp_purchase_price"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="number" id="supp_min_order_qty"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="text" id="supp_measure_unit"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td><input type="text" id="supp_measure_unit"
                                                            class="form-control admin-input">
                                                    </td>
                                                    <td>
                                                        <div class="supplier-add"><button type="button"
                                                                class="btn btn-success btn-sm addSupplierProduct"><i
                                                                    class="fas fa-plus"></i></button></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table text-nowrap thead-bg" id="supplier_table">
                                            <thead>
                                                <tr>
                                                    <th>Supplier</th>
                                                    <th style="width: 14%">Cost</th>
                                                    <th>Tax</th>
                                                    <th style="width: 14%">Exchange Rate</th>
                                                    <th>Cost Date</th>
                                                    <th>Reference</th>
                                                    <th>Comments</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="billing-wrap">
                                <div class="billing-wrap-head">
                                    <p>item count</p>
                                    <h4 id="item_count">0</h4>
                                    <input type="hidden" id="item_count_input" value="0">
                                    <p>sub total</p>
                                    <h4 id="purchase_product_total">0.00</h4>
                                    <input type="hidden" id="purchase_product_total_input" value="0">
                                    <p>Delivery charge</p>
                                    <h4 id="delivery_charge_total">0.00</h4>
                                </div>
                                <div class="billing-wrap-ftr">
                                    <p>total</p>
                                    <h4 id="sub_total">0.00</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="commonBtn-btnTag" type="submit">Submit </button>
                        </div>
                    </div>
                </form>
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
    </script>
@endsection
