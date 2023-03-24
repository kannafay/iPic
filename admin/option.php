<?php

@$ipic_private = stripslashes($_POST['ipic_private']);
@$ipic_private_tpl = stripslashes($_POST['ipic_private_tpl']);
@$ipic_icp = stripslashes($_POST['ipic_icp']);
@$ipic_icp_gov = stripslashes($_POST['ipic_icp_gov']);

if(@stripslashes($_POST['ipic_option'])){
  update_option('ipic_private', $ipic_private);
  update_option('ipic_private_tpl', $ipic_private_tpl);
  update_option('ipic_icp', $ipic_icp);
  update_option('ipic_icp_gov', $ipic_icp_gov);
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
            <p class="description">请确保您的页面中含有别名为〔welcome〕的页面，并启用〔维护/隐私模板〕模板。</p>
          </td>
        </tr>
        <tr>
          <th scope="row">维护/隐私模式 - 模板</th>
          <td>
            <select name="ipic_private_tpl" id="ipic_private_tpl">
              <option value="" <?=get_option("ipic_private_tpl") == '' ? 'selected' : ''?>>落叶与咖啡</option>
              <option value="2" <?=get_option("ipic_private_tpl") == '2' ? 'selected' : ''?>>Bing搜索页</option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">ICP备案号</th>
          <td>
            <input type='text' name='ipic_icp' value='<?=get_option('ipic_icp')?>' class="regular-text"/>
          </td>
        </tr>
        <tr>
          <th scope="row">公网安备备案号</th>
          <td>
            <input type='text' name='ipic_icp_gov' value='<?=get_option('ipic_icp_gov')?>' class="regular-text"/>
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


