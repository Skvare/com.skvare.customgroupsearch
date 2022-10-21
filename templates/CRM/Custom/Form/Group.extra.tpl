{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('.crm-dedupesetting-form-block-user_roles').appendTo('.form-layout');
    });
  </script>
{/literal}

<table class="form-layout-compressed" style="display: none">
  <tr class="crm-dedupesetting-form-block-user_roles">
    <td class="label">{$form.user_roles.label}</td>
    <td>{$form.user_roles.html}
    </td>
  </tr>
</table>
