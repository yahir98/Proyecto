<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=dronesform" method="post" class="col-8 col-offset-2">
  {{if hasErrors}}
    <section class="row">
      <ul class="error">
        {{foreach errores}}
          <li>{{this}}</li>
        {{endfor errores}}
      </ul>
    </section>
  {{endif hasErrors}}
  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  {{if showIdDron}}
  <fieldset class="row">
    <label class="col-5" for="id_product">Código de Drones</label>
    <input type="text" name="id_product" id="id_product" readonly value="{{id_product}}" class="col-7" />
  </fieldset>
  {{endif showIdDron}}
  <fieldset class="row">
    <label class="col-5" for="">Nombre</label>
    <input type="text" name="name" id="name" {{readonly}} value="{{name}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="p">Descripción</label>
    <input type="text" name="description" id="description" {{readonly}} value="{{description}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="price">Precio</label>
    <input type="text" name="price" id="price" {{readonly}} value="{{price}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
  <!--
   <td>{{iddrones}}</td>
    <td>{{dscdrones}}</td>
    <td>{{prcdrones}}</td>
    <td>{{ivadrones}}</td>
    <td>{{estdrones}}</td>
   -->
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=droneslist");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      /*Aqui deberia hacer validación de datos*/
      document.forms[0].submit();
    });
  });
</script>
