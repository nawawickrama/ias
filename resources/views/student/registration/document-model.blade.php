<!-- Main document modal -->
<div class="modal fade modalForm" id="modelupd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="documentForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-icon-warning" role="alert"><i data-feather="alert-circle"></i><b>WARNING
                            :</b> Please fill all the required <a href="{{route('studentInformation')}}">student
                            information</a> before submit the documents.
                    </div>
                    @foreach($documentDetails as $doc)
                        @php
                            $docDetails = $doc->document;
                        @endphp
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Scanned copy of your {{$docDetails->doc_name}} :</label>
                                <input type="file" name="{{$docDetails->doc_name}}" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info bg-white"
                                           @if($doc->option == 'Mandatory') placeholder="{{$docDetails->doc_name}} Mandatory"
                                           @else placeholder="{{$docDetails->doc_name}} can skip" @endif >
                                    <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Browse</button>
                                                </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Upload</button>
                    <input type="hidden" name="formNo" value="3">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Resubmit document modal -->
<div class="modal fade modalForm" id="reUploadModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('reUploadDocument')}}" method="post" enctype="multipart/form-data" id="reUploadDocumentForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Scanned copy of your <span class="doc-name"></span> :</label>
                            <input type="file" name="resubmitDoc" id="resubmitDoc" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info bg-white " id="reUploadInputField" placeholder=""/>
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary btn-re-upload-form" type="button">Browse</button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" name="fileID">
                    <input type="hidden" value="" name="docName">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
