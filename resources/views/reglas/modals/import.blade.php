<div class="modal fade" id="import_add_regla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Import reglas:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <form role="form" name="frm_import_regla" id="frm_import_regla" method="POST" action="{{ route('reglas.importReglas') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group  row">
                                    <label class="col-sm-2 offset-sm-1 col-form-label" for="archivo">Archivo</label>
                                    <div class="custom-file col-sm-6">
                                        <input id="archivo" name="archivo" type="file" required>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">
                            Cancelar
                        </button>
                        <button  type="submit" class="btn btn-primary" id="import" onclick="importar();">
                            Importar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
