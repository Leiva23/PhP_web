function add_pizza (id_pizza)
{
	if (id_pizza <= 0 || id_pizza > 9999)
		return;

	fetch('shopping_cart_add.php?id_pizza=1'+id_pizza)
		.then(data => {
			return data.text();
			}).then(response => {
				console.log(response);
				let quantitiy = document.getElementById("quantity_"+id_pizza);
				
				let value_quantity = parseInt(quantity.innerText);

				quantity.innerText = value_quantity+1;
			});
}
