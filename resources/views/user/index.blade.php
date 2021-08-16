@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg-4 col-md-4">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
          <img src="https://img.icons8.com/material-rounded/50/000000/user.png"alt="profil" class="profile-user-img img-responsive img-circle"/>

          </div>
          <h3 class="profile-username text-center">pak norman</h3>
          <p class="text-muted text-center">Member sejak : 20 Des 2021</p>
      
        
        
          <hr>
          <a href="{{ URL::to('admin/setting') }}" class="btn btn-primary btn-block">Setting</a>
        </div>
      </div>      
    </div>
    <div class="col col-lg-8 col-md-8">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">History Transaksi</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Invoice</th>
                  <th>Sub Total</th>
                  <th>Diskon</th>
                 
                  <th>Total</th>
                  <th>Status Pembayaran</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    1
                  </td>
                  <td>INV-20210810</td>  
                  <td>
                    200.000
                  </td>
                  <td>
                    0                  
                  </td>
                  <td>
                    27.000
                  </td>
                  <td>
                    227.000
                  </td>
                  <td>
                    Belum dibayar
                  </td>
                  <td>
                    Checkout
                  </td>
                  <td>
                    <a href="{{ route('transaksi.show', 1) }}" class="btn btn-sm btn-info mb-2">
                      Detail
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    2
                  </td>
                  <td>INV-20210810</td>  
                  <td>
                    200.000
                  </td>
                  <td>
                    0                  
                  </td>
                  <td>
                    27.000
                  </td>
                  <td>
                    227.000
                  </td>
                  <td>
                    Belum dibayar
                  </td>
                  <td>
                    Checkout
                  </td>
                  <td>
                    <a href="{{ route('transaksi.show', 2) }}" class="btn btn-sm btn-info mb-2">
                      Detail
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    3
                  </td>
                  <td>INV-20210810</td>  
                  <td>
                    200.000
                  </td>
                  <td>
                    0                  
                  </td>
                  <td>
                    27.000
                  </td>
                  <td>
                    227.000
                  </td>
                  <td>
                    Belum dibayar
                  </td>
                  <td>
                    Checkout
                  </td>
                  <td>
                    <a href="{{ route('transaksi.show', 3) }}" class="btn btn-sm btn-info mb-2">
                      Detail
                    </a>
                  </td>
                </tr>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection