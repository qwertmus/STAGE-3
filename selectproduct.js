var all = document.getElementsByClassName("productsearch-result");

function selectEntry(e)
{
    for (let i = 0; i < all.length; i++)
    {
        all[i].className = 'productsearch-result';
    }
    
    var c = (e).querySelector('.productsearch-result');
    c.focus();
    //c.className = 'productsearch-result-clicked';
}