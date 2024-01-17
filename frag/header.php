<header class="space-between">
	<a draggable="false" id="logo" title="Pagina principală" href="/"></a>
	<details id="cartView">
		<summary>
			Coș: <span class="cart-count count">0</span>, <span class="cart-total price">0.00</span>
		</summary>
		<div class="dropdown">
			<form name="cart" action="/checkout.php">
				<table class="cart-table">
					<thead>
						<tr>
							<th>Produs</th>
							<th>Cantitate</th>
							<th>Preț</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<td>Total:</td>
							<td class="cart-count count"></td>
							<td class="cart-total price"></td>
						</tr>
					</tfoot>
				</table>
				<template id="cartBodyRowTemplate">
					<tr>
						<td><?php if (!@$readOnly) {?><span title="Click pentru a șterge" class="cart-remove-item"></span><?php }?></td>
						<td class="count"><input type="number" min="1" required /></td>
						<td class="price"></td>
					</tr>
				</template>
<?php
				if (!@$readOnly) {
?>
				<hr />
				<div class="space-between">
					<button name="cancel" class="cancel" type="button">Anulează</button>
					<button class="accept">Comandă</button>
				</div>
<?php
				}
?>
			</form>
			<span>Coșul este gol.</span>
		</div>
	</details>
</header>
