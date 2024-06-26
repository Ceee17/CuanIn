@extends('layouts.admin-main')

@section('title', 'Pengaturan')

@section('breadcrumb')
    Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.update') }}" method="post" class="form-setting"
                        enctype="multipart/form-data" data-toggle="validator">
                        @csrf
                        <div class="alert alert-info alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                        </div>
                        <div class="form-group row">
                            <label for="company_name" class="col-lg-2 col-form-label">Nama Perusahaan</label>
                            <div class="col-lg-6">
                                <input type="text" name="company_name" class="form-control" id="company_name" required
                                    autofocus>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-lg-2 col-form-label">Telepon</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-2 col-form-label">Alamat</label>
                            <div class="col-lg-6">
                                <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo_path" class="col-lg-2 col-form-label">Logo Perusahaan</label>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" name="logo_path" class="custom-file-input" id="logo_path">
                                    <label class="custom-file-label" for="logo_path">Pilih file...</label>
                                </div>
                                <div class="help-block with-errors"></div>
                                <br>
                                <div class="tampil-logo">
                                    <!-- Placeholder for displaying the logo -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="card_member_path" class="col-lg-2 col-form-label">Kartu Member</label>
                            <div class="col-lg-6">
                                <div class="custom-file">
                                    <input type="file" name="card_member_path" class="custom-file-input"
                                        id="card_member_path">
                                    <label class="custom-file-label" for="card_member_path">Pilih file...</label>
                                </div>
                                <div class="help-block with-errors"></div>
                                <br>
                                <div class="tampil-kartu-member">
                                    <!-- Placeholder for displaying the card member image -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-lg-2 col-form-label">Diskon</label>
                            <div class="col-lg-2">
                                <input type="number" name="discount" class="form-control" id="discount" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note_type" class="col-lg-2 col-form-label">Tipe Nota</label>
                            <div class="col-lg-2">
                                <select name="note_type" class="form-control" id="note_type" required>
                                    <option value="1">Nota Kecil</option>
                                    <option value="2">Nota Besar</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-10 offset-lg-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            showData();

            $('.form-setting').validator().on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                        })
                        .done(response => {
                            showData();
                            $('.alert').fadeIn();
                            setTimeout(() => {
                                $('.alert').fadeOut();
                            }, 3000);
                        })
                        .fail(errors => {
                            alert('Tidak dapat menyimpan data');
                        });
                }
            });

            function showData() {
                $.get('{{ route('setting.show') }}')
                    .done(response => {
                        $('[name=company_name]').val(response.company_name);
                        $('[name=phone_number]').val(response.phone_number);
                        $('[name=address]').val(response.address);
                        $('[name=discount]').val(response.discount);
                        $('[name=note_type]').val(response.note_type);
                        $('title').text(response.company_name + ' | Pengaturan');

                        let words = response.company_name.split(' ');
                        let word = '';
                        words.forEach(w => {
                            word += w.charAt(0);
                        });
                        $('.logo-mini').text(word);
                        $('.logo-lg').text(response.company_name);

                        $('.tampil-logo').html(
                            `<img src="{{ asset('storage') }}/${response.logo_path}" width="200">`);
                        $('.tampil-kartu-member').html(
                            `<img src="{{ asset('storage') }}/${response.card_member_path}" width="300">`);
                        $('[rel=icon]').attr('href', `{{ asset('storage') }}/${response.logo_path}`);
                    })
                    .fail(errors => {
                        alert('Tidak dapat menampilkan data');
                    });
            }

            // Update file input label with selected filename
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass('selected').html(fileName);
            });
        });
    </script>
@endpush
