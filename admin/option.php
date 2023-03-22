<?php

@$ipic_private = stripslashes($_POST['ipic_private']);
@$ipic_private_tpl = stripslashes($_POST['ipic_private_tpl']);
@$ipic_icp = stripslashes($_POST['ipic_icp']);

if(@stripslashes($_POST['ipic_option'])){
  update_option('ipic_private', $ipic_private);
  update_option('ipic_private_tpl', $ipic_private_tpl);
  update_option('ipic_icp', $ipic_icp);
}

?>

<div class="wrap">
  <h1>iPic主题设置</h1>
  <form method="post" action="" novalidate="novalidate">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">维护/隐私模式</th>
          <td>
            <fieldset>
              <label><input type='checkbox' name='ipic_private' value='true' <?=get_option('ipic_private') == 'true' ? 'checked' : ""?>/>开启</label>
            </fieldset>
          </td>
        </tr>
        <tr>
          <th scope="row">维护/隐私模式 - 模板</th>
          <td>
            <select name="ipic_private_tpl" id="ipic_private_tpl">
              <option value="" <?=get_option("ipic_private_tpl") == '' ? 'selected' : ''?>>咖啡与落叶</option>
              <option value="2" <?=get_option("ipic_private_tpl") == '2' ? 'selected' : ''?>>2</option>
              <option value="3" <?=get_option("ipic_private_tpl") == '3' ? 'selected' : ''?>>3</option>
              <option value="4" <?=get_option("ipic_private_tpl") == '4' ? 'selected' : ''?>>4</option>
              <option value="5" <?=get_option("ipic_private_tpl") == '5' ? 'selected' : ''?>>5</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">ICP备案号</th>
          <td>
            <input type='text' name='ipic_icp' value='<?=get_option('ipic_icp')?>' class="regular-text"/>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <input type="submit" name="ipic_option"  class="button button-primary" value="保存更改">
    </p>
    </div>
  </div>
</div>


