<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#516CE5;">
                                    <h5 class="modal-title" id="ModalLabel">Agregar Categoria</h5>

                                </div>
                                <div class="modal-body">
                                    <form action="../controlador/controladorDeCategorias.php?categoria=1" method="POST"
                                        role=form>

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Nombre de la
                                                Categoria:</label>
                                            <textarea class="form-control" id="categoria" name="categoria"
                                                requiere></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary"
                                            name="btnCargarCategoria">Guardar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
