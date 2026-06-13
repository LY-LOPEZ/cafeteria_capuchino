<?php

function normalize_order_workflow($payment_status, $order_status) {
   $payment_status = in_array($payment_status, ['pending', 'completed', 'rejected']) ? $payment_status : 'pending';
   $active_statuses = ['pendiente', 'preparando', 'listo', 'en camino', 'entregado', 'cancelado'];

   if ($payment_status == 'pending') {
      return ['pending', 'pendiente de verificacion'];
   }

   if ($payment_status == 'rejected') {
      return ['rejected', 'cancelado'];
   }

   if (!in_array($order_status, $active_statuses) || $order_status == 'pendiente de verificacion') {
      $order_status = 'pendiente';
   }

   return ['completed', $order_status];
}

function can_generate_invoice($order) {
   return ($order['payment_status'] ?? '') == 'completed' && ($order['order_status'] ?? '') == 'entregado';
}

function paymentStatusLabel($status) {
   $labels = [
      'pending' => 'pendiente',
      'completed' => 'aprobado',
      'rejected' => 'rechazado',
   ];

   return $labels[$status] ?? $status;
}
