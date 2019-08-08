<section>
  <header>
    <h1>Gestión de Drones</h1>
  </header>
  <main>
    <table class="full-width">
      <thead>
        <tr>
          <th>Cod</th>
          <th>Dron</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th class="right">
            <form action="index.php?page=dronesform" method="post">
            <input type="hidden" name="id_product" value="" />
            <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
            <button type="submit" name="btnIns">Agregar</button>
          </form>
          </th>
        </tr>
      </thead>
      <tbody class="zebra">
        {{foreach droneslist}}
        <tr>
          <td>{{id_product}}</td>
          <td>{{name}}</td>
          <td>{{description}}</td>
          <td>{{price}}</td>
          <td class="right">
            <form action="index.php?page=dronesform" method="post">
              <input type="hidden" name="id_product" value="{{id_product}}"/>
              <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
              <button type="submit" name="btnDsp">Ver</button>
              <button type="submit" name="btnUpd">Editar</button>
              <button type="submit" name="btnDel">Eliminar</button>
            </form>
          </td>
        </tr>
        {{endfor droneslist}}
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"> Paginación</td>
        </tr>
      </tfoot>
    </table>
  </main>
</section>
