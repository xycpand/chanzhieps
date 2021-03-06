<?php
$status = zget($widget->params, 'status', 'all');
$limit  = zget($widget->params, 'limit', '10');
$this->loadModel('order');
$mode = zget($this->config->order->statusFields, $status);
$pager = new pager(0, $limit, 1);
$orders = $this->order->getList($mode, $status, 'id desc', $pager);
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($orders as $order):?>
  <tr onclick="$('.orderLink').click();">
    <td class='w-150px'>
    <?php $goods = current($order->products);?>
      <a href="<?php echo helper::createLink('order', 'view', "id={$order->id}");?>" data-toggle='modal'>
      <?php echo $goods->productName . ' X ' . $goods->count;?>
      <?php if(count($order->products) > 1) echo ' ...';?>
      </a>
    </td>
    <td><?php echo $order->amount;?></td>
    <td><?php echo $this->order->processStatus($order);?></td>
    <td><?php echo formatTime($order->createdDate, 'Y-m-d');?></td>
  </tr>
  <?php endforeach;?>
</table>
