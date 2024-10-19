@section('pageTitle')
<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2" id="sectionTitle">
    <div>
        <h3 class="fw-bold mb-3" id="titleContent"></h3>
    </div>
</div>
<div id="buttonDock" style="display: none" class="mb-4">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
        {{__('Buat Sub Folder')}}
      </button>
    {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" /></svg>
        {{__('Tambahkan File')}}
      </button> --}}
</div>
@endsection
<x-app-layout>
    <div class="row" id="isiFolder">

    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{__('Buat Sub Folder Baru')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="" class="form-label">{{__('Nama Folder')}}</label>
                    <input type="text" class="form-control" name="subFolderName" id ="subFolderName">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="" class="form-label">{{__('Gambar Folder')}}</label>
                    <input type="file" class="form-control" name="subFolderPic" id ="subFolderPic">
                    <input type="hidden" name="idMain" id="mainId">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="createSubFolder()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    @section('additional_js')
    <script src="{{ asset('js/main-folder.js') }}"></script>
    @endsection

</x-app-layout>