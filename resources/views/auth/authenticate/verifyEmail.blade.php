@extends('layouts.front')
@section('front-content')
    <section class="otp-page bg-patten2 d-flex justify-content-center align-items-center">
        <div class="otp-page-wrap">
            <span class="otp-page-logo">
                <img class="img-block" src="{{ asset('assets/img/fire-logo.png') }}">
            </span>
            <div class="otp-page-info text-center">
                <h4>Please enter the one time password to verify your Email</h4>
                <p>A code has been sent to email *********{{ '@' . explode('@', $data['email'])[1] }}</p>
                <div class="otp-input-wraap d-flex">
                    <input id="otp_1" name="otp_1" type="number" class="form-control otp-input-style otp-input" minlength="0"
                        maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*" autofocus>
                    <input id="otp_2" name="otp_2" type="number" class="form-control otp-input-style otp-input" minlength="0"
                        maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*">
                    <input id="otp_3" name="otp_3" type="number" class="form-control otp-input-style otp-input" minlength="0"
                        maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*">
                    <input id="otp_4" name="otp_4" type="number" class="form-control otp-input-style otp-input" minlength="0"
                        maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*">
                    <input id="otp_5" name="otp_5" type="number" class="form-control otp-input-style otp-input"
                        minlength="0" maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*">
                    <input id="otp_6" name="otp_6" type="number" class="form-control otp-input-style otp-input"
                        minlength="0" maxlength="1"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        placeholder="*">
                </div>
                <div class="otp-page-btn text-center">
                    <input type="hidden" name="full_name" value="{{ $data['full_name'] }}">
                    <input type="hidden" name="email" value="{{ $data['email'] }}">
                    <input type="hidden" name="ph_no" value="{{ $data['ph_no'] }}">
                    <input type="hidden" name="password" value="{{ $data['password'] }}">
                    <input type="hidden" name="otp" value="{{ $data['otp'] }}">
                    <button type="button" class="otp-vrfy-btn verifyAndRegister">verify</button>
                    <p>Didn't get the code? <a href="javascript:;" class="resent-otp" id="resend_email_otp">Resend</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".otp-input").keyup(function() {
            var key = event.keyCode || event.charCode;
            if (key == 8) {
                $(this).prev('.otp-input').focus();
            } else {
                if (this.value.length == this.maxLength) {
                    $(this).next('.otp-input').focus();
                }
            }
        });
        $(document).on('click', '.verifyAndRegister', function() {
            // toastr.success('Have fun storming the castle!', 'Miracle Max Says')
            var empty = false;
            $('.otp-input').each(function() {
                if ($(this).val() == "") {

                    empty = true;
                    return false;
                }
            });
            if (empty) {
                toastr.error('Please fill out all fields');
            } else {
                var user_otp = $('#otp_1').val() + $('#otp_2').val() + $('#otp_3').val() + $('#otp_4').val() + $(
                    '#otp_5').val() + $('#otp_6').val();
                // alert(user_otp);
                var formData = new FormData();
                formData.append('full_name', $('input[name=full_name]').val());
                formData.append('email', $('input[name=email]').val());
                formData.append('ph_no', $('input[name=ph_no]').val());
                formData.append('password', $('input[name=password]').val());
                formData.append('otp', $('input[name=otp]').val());
                formData.append('user_otp', user_otp);
                formData.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    type: 'POST',
                    url: "{{ route('auth.verify_register') }}",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success == 0) {
                            toastr.error(res.error);
                            $('.otp-input').val('');
                            $('#otp_1').focus();
                        } else {
                            Swal.fire({
                                title: 'Thank You !',
                                text: res.msg,
                                icon: 'success',
                            }).then((result) => {
                                window.location = "{{ route('auth.login') }}";
                            })
                        }
                    }
                });

            }
        })

        $(document).on('click', '#resend_email_otp', function() {
            var formData = new FormData();
            formData.append('email', $('input[name=email]').val());
            formData.append('_token', "{{ csrf_token() }}");

            $.ajax({
                type: 'POST',
                url: "{{ route('auth.email_resend_otp') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#ajax_loader').show();
                },
                complete: function() {
                    $('#ajax_loader').hide();
                },
                success: function(res) {
                    if (res.success == 0) {
                        toastr.error(res.error);
                    } else {
                        $('input[name=otp]').val(res.data.otp);
                        toastr.success('Code sent to the email.');
                    }
                }
            });
        })
    </script>
@endsection
