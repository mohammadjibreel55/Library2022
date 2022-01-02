@extends('backend.layouts.app')

@section('admin-content')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Manage Translators</h1>

      <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i> Add Translators</a>
    </div>

    @include('backend.layouts.partials.messages')

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Translators</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="{{ route('admin.Translators.store') }}" method="post">
              @csrf

              <div class="row">
                <div class="col-md-6">
                  <label for="">Translators Name</label>
                  <br>
                  <input type="text" class="form-control" name="name" placeholder="Translators Name">
                </div>
                <div class="col-md-6">
                  <label for="">Translators Link</label>
                  <br>
                  <input type="text" class="form-control" name="link" placeholder="Translators Link">
                </div>



                <div class="col-12">
                  <label for="">Translators Details</label>
                  <br>
                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Translators Description"></textarea>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>

          </div>

        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Translators Lists</h6>
            </div>
            <div class="card-body">

              <table class="table" id="dataTable">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($Translators as $Translators)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $Translators->name }}</td>
                    <td>{{ $Translators->link }}</td>

                    <td>
                      <a href="#editModal{{ $Translators->id }}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>

                      <a href="#deleteModal{{ $Translators->id }}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>


                  <div class="modal fade" id="editModal{{ $Translators->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Author</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <form action="{{ route('admin.Translators.update', $Translators->id) }}" method="post">
                            @csrf

                            <div class="row">
                              <div class="col-md-6">
                                <label for="">Translators Name</label>
                                <br>
                                <input type="text" class="form-control" name="name" placeholder="Translators Name" value="{{ $Translators->name }}">
                              </div>
                              <div class="col-md-6">
                                <label for="">Translators Link</label>
                                <br>
                                <input type="text" class="form-control" name="link" placeholder="Translators Link"  value="{{ $Translators->link }}">
                              </div>


                              <div class="col-12">
                                <label for="">Translators Details</label>
                                <br>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Translators Description">{!! $Translators->description !!}</textarea>
                              </div>
                            </div>
                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                          </form>

                        </div>

                      </div>
                    </div>
                  </div>


                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModal{{ $Translators->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete ?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <form action="{{ route('admin.Translators.delete', $Translators->id) }}" method="post">
                            @csrf

                            <div>
                              {{ $Translators->name }} will be deleted !!
                            </div>

                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Ok, Confirm</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                          </form>

                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- Delete Modal -->
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

@endsection
