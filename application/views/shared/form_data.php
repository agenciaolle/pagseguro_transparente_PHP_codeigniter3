<div id="modal-data" class="modal hide fade" tabindex="-1"
role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">
			×
		</button>
		<h3>Data do Evento</h3>
	</div>
	<div class="modal-body" id="descricao">
		<?php echo form_open($url_data, array('id' => 'form-data', "class" => "form-horizontal")); ?>
		<div class="control-group">
			<?php echo form_label("Data do Evento:", "data_evento", array("class" => "control-label")); ?>
			<div class="controls">
				<?php echo form_input(array("name" => "data_evento", "id" => "data_evento", "value" => set_value('data_evento'))); ?>
				<?php echo form_error('data_evento'); ?>
			</div>
		</div>
		<table class="table">
			<tr>
				<th>
					Horário de Início
				</th>
				<th>
					Horário de Fim
				</th>
				<th>
					Descrição
				</th>
			</tr>
			<?php 
			for ($i=0; $i < 3; $i++) {
				 $hora_inicio = "hora_inicio_".$i;
				 $hora_fim = "hora_fim_".$i;
				 $descricao = "descricao_".$i;
				?>
				<tr>
				<td>
					<?php echo form_input(array("name" => $hora_inicio, "id" => $hora_inicio, "class" => "span6 hora", "value" => set_value($hora_inicio))); ?>
					<?php echo form_error($hora_inicio); ?>
				</td>
				<td>
					<?php echo form_input(array("name" => $hora_fim, "id" => $hora_fim, "class" => "span6 hora", "value" => set_value($hora_fim))); ?>
					<?php echo form_error($hora_fim); ?>
				</td>
				<td>
					<?php echo form_input(array("name" => $descricao, "id" => $descricao, "class" => "span6", "value" => set_value($descricao))); ?>
					<?php echo form_error($descricao); ?>
				</td>
			</tr>
				<?php } ?>
			
		</table>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">
			Fechar
		</button>
		<button type="submit" class="btn btn-primary" aria-hidden="true">
			Adicionar
		</button>
	</div>
</div>
<?php echo form_close(); ?>
</div>
<script>
	$('#modal-contato #button-selecionar-registro').click(function(e) {
		e.preventDefault();
		idRegistro = $("#modal-contato input[name=registro]:checked").val();
		nmRegistro = $("#modal-contato #registro_" + idRegistro + " .nome_registro").html().trim();
		$("#contato_id").val(idRegistro);
		$("#contato_nome").val(nmRegistro);
		$('#modal-contato').modal("hide");
	});
	$('#modal-contato #button-filtrar-registro').click(function(e) {
		e.preventDefault();
		$('#modal-contato #lista-registros').empty();
		pesquisar_contatos();
	});
	$("#data_evento").mask("99/99/9999");
	$(".hora").mask("99:99"); 
</script>