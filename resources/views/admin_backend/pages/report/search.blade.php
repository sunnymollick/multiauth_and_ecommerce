@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Search Report</h5>
    </div><!-- sl-page-title -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card pd-20 pd-sm-40">
                <form method="POST" action="{{ route('search.by.date') }}">
                  @csrf
                  <div class="modal-body pd-20">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Search By Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Enter Date" id="brand_name" required>
                      </div>
                      <button type="submit" class="btn btn-info pd-x-20">Search</button>
                      </div>
                  </form>
              </div><!-- card -->
        </div>


        <div class="col-lg-4">
            <div class="card pd-20 pd-sm-40">
                <form method="POST" action="{{ route('search.by.month') }}">
                  @csrf
                  <div class="modal-body pd-20">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Search By Month</label>
                        <select name="month" class="form-control" id="">
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="october">October</option>
                            <option value="november">November</option>
                            <option value="december">December</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-info pd-x-20">Search</button>
                      </div>
                  </form>
              </div><!-- card -->
        </div>


        <div class="col-lg-4">
            <div class="card pd-20 pd-sm-40">
                <form method="POST" action="{{ route('search.by.year') }}">
                  @csrf
                  <div class="modal-body pd-20">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Search By Year</label>
                        <select name="year" class="form-control" id="">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-info pd-x-20">Search</button>
                      </div>
                  </form>
              </div><!-- card -->
        </div>


    </div>



  </div><!-- sl-pagebody -->


@endsection
