<!-- Modal -->
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<div id="ticketModal_{{ $ticket->id }}" data-ticket="{{ $ticket->id }}" data-ticketstatus="{{ $ticket->status }}" class="modal fade detalhe-ocorrencia" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="#" data-dismiss="modal"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="fase">
                            <div class="box-fase {{ $ticket->status >= 1 ? null : 'disabled'  }}">
                                <div class="content">
                                    <div class="circle"></div>
                                    <div class="text">Abertura</div>
                                </div>
                            </div>
                            <div class="box-fase {{ $ticket->status < 2 ? 'disabled' : null  }}">
                                <div class="content">
                                    <div class="circle"></div>
                                    <div class="text">Pré-Análise</div>
                                </div>
                            </div>
                            <div class="box-fase {{ $ticket->status < 3 ? 'disabled' : null  }}">
                                <div class="content">
                                    <div class="circle"></div>
                                    <div class="text">Tratamento</div>
                                </div>
                            </div>
                            <div class="box-fase {{ $ticket->status < 4 ? 'disabled' : null  }}">
                                <div class="content">
                                    <div class="circle"></div>
                                    <div class="text">pós-análise</div>
                                </div>
                            </div>
                            <div class="box-fase {{ $ticket->status < 5 ? 'disabled' : null  }}">
                                <div class="content">
                                    <div class="circle"></div>
                                    <div class="text">Encerramento</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($ticket->status == '5' )
                    <div class="col-sm-2">
                        <a data-toggle="modal" href="#justyes_{{ $ticket->id }}" class="btn btn-primary btn-block"><b>Ocorrência Aprovada</b></a>
                        <a data-toggle="modal" href="#justno_{{ $ticket->id }}" class="btn btn-danger btn-block"><b>Ocorrência Não Aprovada</b></a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-body">
                <h2>Dados da Empresa</h2>
                <div class="panel panel-default dados-da-empresa">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h3>{{ $ticket->atendido->nome_empresa }}</h3>
                                <h4>CNPJ/CPF: {{ $ticket->atendido->doc }}</h4>
                                <h4>Resp.: {{ $ticket->atendido->nome_contato }}</h4>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                {{ $ticket->atendido->endereco }}
                                {{ $ticket->atendido->num != '' ? ', '.$ticket->atendido->num : null}}
                                  {{ $ticket->atendido->comp != '' ? ', '.$ticket->atendido->comp : null}}
                                    {{ $ticket->atendido->bairro != '' ? ' - '.$ticket->atendido->bairro : null}}
                                </p>
                                <p>CEP: {{ $ticket->atendido->cep }} - {{ $ticket->atendido->cidade }} - {{ $ticket->atendido->estado }}</p>
                            </div>
                            <div class="col-sm-4">
                                <p>Tel.: {{ $ticket->atendido->tel }}</p>
                                <p>{{ $ticket->atendido->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Dados da Ocorrência</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default dados-da-ocorrencia">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3>Código: {{ $ticket->ref }}</h3>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="time-box">
                                            <i class="icon icon-arrows-circle-downleft"></i>
                                            <div class="time">
                                                <div>
                                                   <span class="{{ $ticket->getPercentClass() }}" style="width: {{ $ticket->getPercentFinish() }}%"></span>
                                                </div>
                                            </div>
                                             <p style="text-align: right; font-size:11px; color: #adadad;" id="t_{{ $ticket->id }}" data-time="{{ $ticket->getTimeToFinish(true) }}" class="timer">faltam: {{ $ticket->getTimeToFinish() }}</p>
                                    @if($ticket->getHourDiff() < 1)
                                    <script>
                                       
                                         setInterval(function(){
                                          var res = $('#t_{{ $ticket->id }}').data('time')
                                          
                                           res = parseInt(res);
                                           if(res >= 0){
                                               var f = res-1;
                                               var ftexto = 'Faltam '+f+' min(s)';
                                               if(f <= '0'){
                                                ftexto = 'Tempo esgotado';
                                               }
                                               $('#t_{{ $ticket->id }}').data('time',f);
                                               $('#t_{{ $ticket->id }}').text(ftexto);
                                            }
                                         }, 60000);
                                     

                                    </script>
                                    @endif
                                        </div>
                                    </div>
                                </div>
                                <h4><b>Nota Fiscal</b>: {{ $ticket->nf }}</h4>
                                <h5>tipo de ocorrência</h5>
                                <div class="form-inline">
                                    <div class="form-group">
                                        @if($user->group_id == '1')
                                        <span class="response"></span>
                                        {{ Form::select('ocorrencia_id', $ocorrencias, $ticket->ocorrencia->id,['class'=>'form-control']) }}
                                            <a data-ticket="{{ $ticket->id }}" class="ocur_btn" href="javaScript:;"><i class="icon icon-software-pencil"></i></a>
                                            <div id="alert_{{ $ticket->id }}" style="display: none;" class="alert alert-success">Ok feito com sucesso</div>
                                        @else
                                            <input type="text" readonly="readonly" value="{{ $ticket->ocorrencia->name }}" class="form-control">
                                        @endif
                                    </div>
                                </div>
                                <h5>Endereço da ocorrência</h5>
                                <p>{{ $ticket->atendido->endereco }}
                                {{ $ticket->atendido->num != '' ? ', '.$ticket->atendido->num : null}}
                                  {{ $ticket->atendido->comp != '' ? ', '.$ticket->atendido->comp : null}}
                                   {{ $ticket->atendido->bairro != '' ? ' - '.$ticket->atendido->bairro : null}}</p>
                                <p>CEP: {{ $ticket->atendido->cep }} - {{ $ticket->atendido->cidade }} - {{ $ticket->atendido->estado }}</p>
                                <br>
                                <h5>Responsável</h5>
                                <p>{{ $ticket->atendido->nome_contato }}</p>
                                <p>Tel.: {{ $ticket->atendido->tel }}</p>
                                <p>{{ $ticket->atendido->email }}</p>
                                <br>
                                <h5>Fotos</h5>
                                @if($ticket->imagens->count() > 0)
                                @foreach($ticket->imagens->chunk(6) as $chunk)
                                <div class="row fotos">
                                    @foreach($chunk as $img)
                                    <div class="col-sm-2">
                                        <img draggable="false" src="{{ asset('uploads/thumbs/'.$img->src) }}" class="img">
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Sem imagens anexadas</p>
                                    </div>
                                </div>
                                @endif

                                <div style="margin-bottom:10px;"></div>

                                @if($ticket->produtos->count() > 0)
                                <div class="lista-de-produtos">
                                    <h2>lista de Produtos</h2>
                                    <ul>
                                        @foreach($ticket->produtos as $p)
                                        <li>
                                            <h4>{{ $p->produto->name or null }}</h4>
                                            <h5>{{ $p->quantidade }} unidade(s)</h5>

                                            <h6>Defeito:</h6>
                                            <p>{{ $p->defeito }}</p>
                                            @if($p->outro_defeito != '')
                                            <h6>Outro defeito</h6>
                                            <p>{{ $p->outro_defeito }}</p>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                               @endif
                                @if($ticket->materiaisFaltando->count() > 0)
                                    <div class="lista-de-produtos">
                                         <h2>Lista de materiais (incorretos/faltando)</h2>
                                        <ul>
                                            @foreach($ticket->materiaisFaltando as $material)
                                                <h4>{{ $material->produto->name or null }}</h4>
                                                <p>Produto comprado: {{  $material->getProduct($material->produto_comprado) }}</p>
                                                <p>Produto entregue: {{ $material->getProduct($material->produto_entregue) }}</p>
                                                <p>Quantidade comprado: {{ $material->quantidade_comprado or '--' }}</p>
                                                <p>Quantidade entregue: {{ $material->quantidade_entregue or '--' }}</p>
                                                <p>Transportadora: {{ $material->transportadora }}</p>
                                                <p>Motorista: {{ $material->motorista }}</p>
                                                <p>Placa do caminhão: {{ $material->placa_caminhao }}</p>
                                                <p>Houve relato? {{ $material->relato == 'Sim' ? 'Sim' : 'Não' }}</p>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Descrição</h5>
                                        <p>{{ $ticket->descricao_ocorrido }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($user->group_id == '1' or $user->group_id == '2')
                        <div class="panel panel-gray-2 emails" style="margin-bottom: 10px;">
                            <div class="panel-header">
                                Usuários participando da ocorrência
                               
                            </div>
                           
                            <div class="panel-body">
                                <input class="emails_input" value="{{ $ticket->tratadores_emails() }}">
                                <a href="javaScript:;" data-ticket="{{ $ticket->id }}" class="btn add_to_ticket btn-gray">Atualizar</a>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                 <div style="display: none;" class="alert alert-success text-center emails_alert"></div>
                                <div style="display: none;" class="load_action_1 text-center alert alert-warning">Carrengando ...</div>
                            </div>
                        </div>
                        <div class="panel panel-gray-2" style="margin-bottom: 10px;">
                            <div class="panel-header">
                                Interação entre áreas
                            </div>
                            <div class="panel-body">

                                <textarea class="ckeditor" id="message_{{ $ticket->id }}" name="message_{{ $ticket->id }}"></textarea>
                                <script type="text/javascript">
                                
                                    CKEDITOR.replace('message_{{ $ticket->id }}', {
                                      "filebrowserImageUploadUrl": "/resources/sakonline/public//js/ckeditor/plugins/imgupload_2.1/iaupload.php"
                                    });

                                    CKEDITOR.config.filebrowserUploadUrl = '/resources/sakonline/public//js/ckeditor/plugins/filebrowser/upload.php';
                                </script>
                                <a href="javaScript:;" id="save_message" data-ticket="{{ $ticket->id }}" class="btn btn-gray save_message pull-right disabled" style="margin: 0 20px 20px 0">Salvar</a>                            </div>

                        </div>
                        <div style="display: none;" class="row message_alert">
                            <div class="col-md-12">
                                <div class="alert alert-success text-center"></div>
                            </div>
                        </div>
                        <div class="time-line time_line_{{ $ticket->id }}">
                            @foreach($ticket->comments as $comment)
                            <div class="row">
                                <div class="image">
                                    <img src="{{ $comment->user->getImageUrl() }}">
                                </div>
                                <div class="text">
                                    <h4>{{ $comment->user->name }} | {{ $comment->user->getAreaName() }} <span>[{{ $comment->getFaseName() }}]</span></h4>
                                    <h5>{{ Helper::Extenso($comment->created_at) }}  | {{ Helper::Hora($comment->created_at) }}</h5>
                                    {{ $comment->message }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                @if($ticket->status == '5')
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-danger"><b>Ocorrência Não Aprovada</b></a>
                            <a href="#" class="btn btn-primary"><b>Ocorrência Aprovada</b></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- Aqui mostro painel de justificativa --}}
@if($ticket->status == '5')
@include('ticket.partials.justify', ['action'=>'Completar'])
@endif