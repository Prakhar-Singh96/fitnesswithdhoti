@extends('admin.layout.layout')
@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Add IPL Team</div>
                <div class="card-body">
                    <form action="{{ route('admin.ipl.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Team Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. CSK">
                        </div>
                        <div class="mb-3">
                            <label>Coupon Code</label>
                            <input type="text" name="coupon_code" class="form-control" required placeholder="e.g. CSKWIN50">
                        </div>
                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control" required>
                        </div>
                        <button class="btn btn-success w-100">Save Team</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4 shadow-sm border-warning">
                <div class="card-header bg-warning">Declare Match Winner</div>
                <div class="card-body">
                    <form action="{{ route('admin.ipl.declare_winner') }}" method="POST">
                        @csrf
                        <select name="team_id" class="form-control mb-3">
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-dark w-100">Set as Winner (Activate Coupons)</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Team</th>
                                <th>Coupon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                            <tr>
                                <td><img src="{{ asset($team->logo) }}" width="50"></td>
                                <td>{{ $team->name }}</td>
                                <td><span class="badge bg-info text-dark">{{ $team->coupon_code }}</span></td>
                                <td>
                                    <a href="{{ route('admin.ipl.delete', $team->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
