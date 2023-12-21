export default function addToCarts(product) {
    let array = JSON.parse(localStorage.getItem('addToCarts')) ?? [];
    let data = {
        id:product.id,
        productName:product.name,
        imageUrl:product.image_url,
        base_price:product.unit_price,
        quantity_price:product.unit_price,
        quantity:1
    };
    if(!array.includes(data)){
        array.push(data);
    }
    localStorage.setItem('addToCarts',JSON.stringify(array));
}