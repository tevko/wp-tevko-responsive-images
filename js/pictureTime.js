// pictureTime polyfill by Chuck Carpenter for National Geographic, 2012

// much observed from the picturefill polyfill by Scott Jehl
// http://github.com/scottjehl/picturefill

// needed to change markup to respect actual picture element and double density photos


!function(){var a;a=function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u;for(i=document.getElementsByTagName("picture"),b=window.devicePixelRatio||1,p=0,s=i.length;s>p;p++){if(f=i[p],d=[],l=f.getElementsByTagName("source"),""===f.innerHTML)return null;for(l.length||(h=f.innerHTML,c=document.createElement("div"),o=h.replace(/(<)source([^>]+>)/gim,"$1div$2").match(/<div[^>]+>/gim),c.innerHTML=o.join(""),l=c.getElementsByTagName("div")),q=0,t=l.length;t>q;q++)if(k=l[q],e=k.getAttribute("media"),!e||window.matchMedia&&window.matchMedia(e).matches){d.push(k);break}if(g=f.getElementsByTagName("img")[0],0!==d.length){if(g||(g=document.createElement("img"),g.alt=f.getAttribute("alt"),f.appendChild(g)),n=d.pop().getAttribute("srcset"),b&&-1!==n.indexOf(" 2x")){for(n=n.split(","),r=0,u=n.length;u>r;r++)if(m=n[r],m=m.replace(/^\s*/,"").replace(/\s*$/,"").split(" "),j=parseFloat(m[1],10),b===j){a=m[0];break}}else a=n.split(" ")[0];g.src=a,console.log(g.src)}else g&&f.removeChild(g)}},window.addEventListener?(window.addEventListener("resize",a,!1),window.addEventListener("DOMContentLoaded",function(){return a(),window.removeEventListener("load",a,!1)},!1),window.addEventListener("load",a,!1)):window.attachEvent("onload",a),"function"==typeof define&&define(function(){return a}),a()}.call(this);