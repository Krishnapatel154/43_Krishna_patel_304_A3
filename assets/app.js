document.addEventListener('DOMContentLoaded', () => {
  const holder = document.querySelector('#product-list');
  if (!holder) return;
  const category = holder.dataset.category;
  async function load(page=1) {
    holder.innerHTML = '<p>Loading...</p>';
    try {
      const response = await fetch(`ajax/products.php?category=${encodeURIComponent(category)}&page=${page}`);
      if (!response.ok) throw new Error('Request failed');
      const data = await response.json();
      if (!data.products.length) { holder.innerHTML='<p>No products in this category yet.</p>'; return; }
      const grid=document.createElement('div'); grid.className='products';
      data.products.forEach(p => {
        const card=document.createElement('article'); card.className='product';
        if (p.picture) { const img=document.createElement('img'); img.src=p.picture; img.alt=p.pname; card.appendChild(img); }
        const title=document.createElement('h3'); title.textContent=p.pname; card.appendChild(title);
        const price=document.createElement('p'); price.textContent=`Price: ${Number(p.price).toFixed(2)}`; card.appendChild(price);
        const link=document.createElement('a'); link.href=`cart.php?add=${p.id}`; link.textContent='Add to cart'; card.appendChild(link);
        grid.appendChild(card);
      });
      const pages=document.createElement('div'); pages.className='pagination';
      for(let i=1;i<=data.pages;i++){const b=document.createElement('button');b.type='button';b.textContent=i;b.disabled=i===data.page;b.addEventListener('click',()=>load(i));pages.appendChild(b);}
      holder.replaceChildren(grid,pages);
    } catch(e) { holder.textContent='Could not load products. Check PHP/database setup.'; }
  }
  load();
});