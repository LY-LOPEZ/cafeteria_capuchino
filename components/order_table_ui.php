<?php

function orderStatusClass($status) {
   return str_replace(' ', '-', strtolower(trim((string)$status)));
}

function renderPaymentProofControl($order) {
   if (($order['payment_proof'] ?? '') == '') {
      return;
   }

   $proofUrl = publicAssetUrl('uploaded_img/' . $order['payment_proof']);
   $reference = $order['payment_reference'] ?? '';

   echo '<button type="button" class="proof-link js-proof-open" data-proof-src="' . htmlspecialchars($proofUrl, ENT_QUOTES, 'UTF-8') . '" data-proof-ref="' . htmlspecialchars($reference, ENT_QUOTES, 'UTF-8') . '"><i class="fas fa-receipt"></i> comprobante</button>';
}

function renderOrderActionsControl($order, $current_page) {
   $orderId = (int)$order['id'];
   $modalId = 'order-action-modal-' . $orderId;
   $paymentStatus = $order['payment_status'] ?? 'pending';
   $orderStatus = $order['order_status'] ?? 'pendiente';

   ?>
   <div class="order-action-summary">
      <button type="button" class="manage-order-btn js-order-open" data-modal-target="<?= $modalId; ?>">
         <i class="fas fa-sliders-h"></i> Gestionar
      </button>
   </div>

   <div class="order-modal" id="<?= $modalId; ?>" aria-hidden="true">
      <div class="order-modal__panel" role="dialog" aria-modal="true" aria-labelledby="<?= $modalId; ?>-title">
         <button type="button" class="order-modal__close js-modal-close" aria-label="Cerrar">&times;</button>
         <div class="order-modal__header">
            <span>Pedido #<?= $orderId; ?></span>
            <h2 id="<?= $modalId; ?>-title">Gestionar estados</h2>
         </div>

         <form action="" method="POST" class="order-modal-form">
            <input type="hidden" name="order_id" value="<?= $orderId; ?>">
            <label>
               <span>Estado de pago</span>
               <select name="payment_status" class="drop-down">
                  <option value="<?= htmlspecialchars($paymentStatus, ENT_QUOTES, 'UTF-8'); ?>" selected><?= htmlspecialchars($paymentStatus, ENT_QUOTES, 'UTF-8'); ?></option>
                  <option value="pending">pendiente</option>
                  <option value="completed">aprobado</option>
                  <option value="rejected">rechazado</option>
               </select>
            </label>
            <label>
               <span>Estado del pedido</span>
               <select name="order_status" class="drop-down">
                  <option selected value="<?= htmlspecialchars($orderStatus, ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($orderStatus, ENT_QUOTES, 'UTF-8'); ?></option>
                  <option value="pendiente de verificacion">pendiente de verificacion</option>
                  <option value="pendiente">pendiente</option>
                  <option value="preparando">preparando</option>
                  <option value="listo">listo</option>
                  <option value="en camino">en camino</option>
                  <option value="entregado">entregado</option>
                  <option value="cancelado">cancelado</option>
               </select>
            </label>
            <div class="order-modal-actions">
               <button type="submit" class="btn" name="update_payment"><i class="fas fa-save"></i> actualizar</button>
               <?php if (can_generate_invoice($order)) { ?>
                  <a href="invoice.php?id=<?= $orderId; ?>" class="option-btn"><i class="fas fa-file-invoice"></i> factura</a>
               <?php } ?>
               <a href="<?= htmlspecialchars($current_page, ENT_QUOTES, 'UTF-8'); ?>?delete=<?= $orderId; ?>" class="delete-btn" onclick="return confirm('eliminar este pedido?');"><i class="fas fa-trash"></i> eliminar</a>
            </div>
         </form>
      </div>
   </div>
   <?php
}

function renderOrderProofModalRoot() {
   ?>
   <div class="order-modal proof-modal" id="payment-proof-modal" aria-hidden="true">
      <div class="order-modal__panel proof-modal__panel" role="dialog" aria-modal="true" aria-labelledby="payment-proof-title">
         <button type="button" class="order-modal__close js-modal-close" aria-label="Cerrar">&times;</button>
         <div class="order-modal__header">
            <span id="payment-proof-ref">Comprobante QR</span>
            <h2 id="payment-proof-title">Comprobante del cliente</h2>
         </div>
         <img id="payment-proof-img" src="" alt="Comprobante de pago QR">
      </div>
   </div>
   <?php
}
