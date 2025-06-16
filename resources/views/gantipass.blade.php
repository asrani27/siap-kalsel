@extends('layouts.userapp')

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-success">

                <form method="post" action="/gantipass">
                    @csrf
                    <div class="widget-user-image">
                        Masukkan Password Baru
                    </div>
                    <input type="text" class="form-control" name="password">

                    <div class="widget-user-image">
                        Masukkan Lagi Password Baru
                    </div>
                    <input type="text" class="form-control" name="confirm_password"><br />
                    <button type="submit" class="btn btn-md btn-primary btn-block">Update Password</button>
                </form>

            </div>
            <div class="card-footer p-0">
            </div>

        </div>
        <!-- /.widget-user -->
    </div>
</div>
@endsection