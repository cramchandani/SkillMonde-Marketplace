function dateStringToTimeAgo(o){let n=new Date,t=new Date(o);console.log(t);let e=Math.floor((n-t)/1e3),l=Math.floor(e/60),r=Math.floor(l/60),f=Math.floor(r/24);return e<60?"just now":l<60?`${l}m ago`:r<24?`${r}h ago`:f<7?`${f}d ago`:`${Math.floor(f/7)}w ago`}function debounce(o,n){let t;return function(...e){clearTimeout(t),t=setTimeout(()=>{o.apply(this,e)},n)}}