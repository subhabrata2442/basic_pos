@extends('layouts.admin')
@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post"
                    action="{{ route('admin.stock.product.edit', [base64_encode($data['products']->id)]) }}"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <x-alert />
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" class="form-control admin-input" id="product_code" name="product_code"
                                    value="{{ old('product_code', $data['products']->product_code) }}" required
                                    autocomplete="off">
                                @error('product_code')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="default_purchase_price" class="form-label">Default Purchase Price</label>
                                <input type="text" class="form-control admin-input" id="default_purchase_price"
                                    name="default_purchase_price"
                                    value="{{ old('default_purchase_price', $data['products']->default_purchase_price) }}"
                                    required autocomplete="off">
                                @error('default_purchase_price')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purchase_tax_rate" class="form-label">Purchase Tax Rate</label>
                                <input type="number" class="form-control admin-input" id="purchase_tax_rate"
                                    name="purchase_tax_rate"
                                    value="{{ old('purchase_tax_rate', $data['products']->purchase_tax_rate) }}" required
                                    autocomplete="off">
                                @error('purchase_tax_rate')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="min_order_qty" class="form-label">Minimum Order Quantity</label>
                                <input type="number" class="form-control admin-input" id="min_order_qty"
                                    name="min_order_qty"
                                    value="{{ old('min_order_qty', $data['products']->min_order_qty) }}" required
                                    autocomplete="off">
                                @error('min_order_qty')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pack_size" class="form-label">Pack Size</label>
                                <input type="text" class="form-control admin-input" id="pack_size" name="pack_size"
                                    value="{{ old('pack_size', $data['products']->pack_size) }}" required
                                    autocomplete="off">
                                @error('pack_size')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_desc" class="form-label">Product Description</label>
                                <textarea name="product_desc" rows="3" id="product_desc" class="form-control admin-textarea" required>{{ old('product_desc', $data['products']->product_desc) }}</textarea>
                                @error('product_desc')
                                    <div class="error admin-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="nav-list-wrap">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">Suppliers</button>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="suppliers-table table-responsive">
                                        <table class="table text-nowrap bt-none">
                                            <thead>
                                                <tr>
                                                    <th style="width: 14%">Supplier Code</th>
                                                    <th>supplier name</th>
                                                    <th style="width: 14%">supplier product code</th>
                                                    <th>product desc.</th>
                                                    <th>purchase price</th>
                                                    <th>min. order qty.</th>
                                                    <th>unit of measure</th>
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
                                                    <td><input type="text" id="supp_name" class="form-control admin-input"
                                                            readonly>
                                                    </td>
                                                    <td><input type="text" id="supp_product_code"
                                                            class="form-control admin-input">
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
                                                    <th>Default</th>
                                                    <th style="width: 14%">Supplier Code</th>
                                                    <th>supplier name</th>
                                                    <th style="width: 14%">supplier product code</th>
                                                    <th>product desc.</th>
                                                    <th>purchase price</th>
                                                    <th>min. order qty.</th>
                                                    <th>unit of measure</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['products']->supplier_product as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox chk-style">
                                                                <input type="checkbox"
                                                                    name="supp_default[{{ $loop->iteration }}]"
                                                                    @if ($item->is_default == 1) checked @endif
                                                                    value="1" id="supp_default{{ $loop->iteration }}"
                                                                    class="supp_default">
                                                                <label for="supp_default{{ $loop->iteration }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $item->supplier_dtl->sup_code }}
                                                            <input type="hidden" name="supp_code[]"
                                                                value="{{ $item->supplier_id }}">
                                                        </td>
                                                        <td>
                                                            {{ $item->supplier_dtl->sup_name }}
                                                            <input type="hidden" name="supp_name[]"
                                                                value="{{ $item->supplier_dtl->sup_name }}">
                                                        </td>
                                                        <td>
                                                            <div contenteditable class="edit-input">
                                                                {{ $item->supp_product_code }}
                                                            </div>
                                                            <input type="hidden" name="supp_product_code[]"
                                                                value="{{ $item->supp_product_code }}">
                                                        </td>
                                                        <td>
                                                            <div contenteditable class="edit-input">
                                                                {{ $item->supp_product_desc }}
                                                            </div>
                                                            <input type="hidden" name="supp_product_desc[]"
                                                                value="{{ $item->supp_product_desc }}">
                                                        </td>
                                                        <td>
                                                            <div contenteditable class="edit-input allowNumeric">
                                                                {{ $item->supp_purchase_price }}</div>
                                                            <input type="hidden" name="supp_purchase_price[]"
                                                                value="{{ $item->supp_purchase_price }}">
                                                        </td>
                                                        <td>
                                                            <div contenteditable class="edit-input allowNumeric">
                                                                {{ $item->supp_min_order_qty }}</div>
                                                            <input type="hidden" name="supp_min_order_qty[]"
                                                                value="{{ $item->supp_min_order_qty }}">
                                                        </td>
                                                        <td>
                                                            <div contenteditable class="edit-input">
                                                                {{ $item->supp_measure_unit }}
                                                            </div>
                                                            <input type="hidden" name="supp_measure_unit[]"
                                                                value="{{ $item->supp_measure_unit }}">
                                                        </td>
                                                        <td>
                                                            <div class="supplier-add">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-td"><i
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
                        <div class="row">
                            <div class="col-12">
                                <button class="commonBtn-btnTag" type="submit">Submit </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
