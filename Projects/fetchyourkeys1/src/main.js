import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')

 // Gestion du menu utilisateur
 document.getElementById('user-menu-button').addEventListener('click', function() {
    const menu = document.getElementById('user-menu');
    menu.classList.toggle('hidden');
  });

  // Fermer le menu utilisateur en cliquant à l'extérieur
  document.addEventListener('click', function(event) {
    const menu = document.getElementById('user-menu');
    const button = document.getElementById('user-menu-button');
    
    if (!button.contains(event.target) && !menu.contains(event.target)) {
      menu.classList.add('hidden');
    }
  });

  // Sidebar toggle (mobile)
  (function(){
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const btnOpen = document.getElementById('sidebar-open');
    const btnClose = document.getElementById('sidebar-close');
    const overlay = document.getElementById('mobile-overlay');
    function openSidebar(){
      if(!mobileSidebar) return;
      mobileSidebar.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
      const btn = document.getElementById('sidebar-open');
      if(btn) btn.setAttribute('aria-expanded', 'true');
      // animate in
      requestAnimationFrame(()=>{
        if(overlay) overlay.classList.remove('opacity-0');
        const panel = document.getElementById('mobile-panel');
        if(panel) panel.classList.remove('-translate-x-full');
      });
    }
    function closeSidebar(){
      if(!mobileSidebar) return;
      // animate out
      if(overlay) overlay.classList.add('opacity-0');
      const panel = document.getElementById('mobile-panel');
      if(panel) panel.classList.add('-translate-x-full');
      setTimeout(()=>{
        mobileSidebar.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        const btn = document.getElementById('sidebar-open');
        if(btn) btn.setAttribute('aria-expanded', 'false');
      }, 300);
    }
    if(btnOpen) btnOpen.addEventListener('click', openSidebar);
    if(btnClose) btnClose.addEventListener('click', closeSidebar);
    if(overlay) overlay.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') closeSidebar(); });
  })();