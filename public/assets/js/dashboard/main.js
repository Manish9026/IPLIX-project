gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
    initDashboardAnimations();
    initSidebar();
    initQuickActions();
});

function initDashboardAnimations() {
    // Initial load animations
    const tl = gsap.timeline();
    
    // Animate sidebar
    tl.fromTo('#sidebar', 
        { x: -300, opacity: 0 },
        { x: 0, opacity: 1, duration: 0.8, ease: 'power3.out' }
    )
    // Animate header
    .fromTo('header', 
        { y: -50, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.6, ease: 'power3.out' },
        '-=0.5'
    )
    // Animate content
    .fromTo('.page-content:not(.hidden)', 
        { y: 30, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.6, ease: 'power3.out' },
        '-=0.3'
    );

    // Animate metric cards with stagger
    gsap.fromTo('.metric-card', 
        { 
            y: 50, 
            opacity: 0, 
            scale: 0.9,
            rotationY: 45
        },
        { 
            y: 0, 
            opacity: 1, 
            scale: 1,
            rotationY: 0,
            duration: 0.8, 
            ease: 'power3.out',
            stagger: 0.1,
            delay: 0.5
        }
    );

    // Animate tables with fade and slide
    gsap.fromTo('.data-table tbody tr', 
        { 
            x: -30, 
            opacity: 0 
        },
        { 
            x: 0, 
            opacity: 1,
            duration: 0.5, 
            ease: 'power3.out',
            stagger: 0.1,
            delay: 0.8
        }
    );

    // Animate action buttons
    gsap.fromTo('.action-btn', 
        { 
            scale: 0.8, 
            opacity: 0,
            rotation: -10
        },
        { 
            scale: 1, 
            opacity: 1,
            rotation: 0,
            duration: 0.6, 
            ease: 'back.out(1.7)',
            stagger: 0.05,
            delay: 1
        }
    );

    // Continuous pulse animation for status indicators
    gsap.to('.bg-green-400, .bg-yellow-400, .bg-blue-400', {
        scale: 1.2,
        duration: 1,
        ease: 'power2.inOut',
        yoyo: true,
        repeat: -1,
        stagger: 0.2
    });

    // Hover animations for cards
    gsap.utils.toArray('.card-hover').forEach(card => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                scale: 1.02,
                y: -5,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                scale: 1,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Table row hover effects
    gsap.utils.toArray('.data-table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', () => {
            gsap.to(row, {
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                duration: 0.2,
                ease: 'power2.out'
            });
        });

        row.addEventListener('mouseleave', () => {
            gsap.to(row, {
                backgroundColor: 'transparent',
                duration: 0.2,
                ease: 'power2.out'
            });
        });
    });
}

function initSidebar() {
    const mobileMenu = document.getElementById('mobile-menu');
    const closeSidebar = document.getElementById('close-sidebar');
    const overlay = document.getElementById('mobile-overlay');
    const sidebar = document.getElementById('sidebar');

    // Mobile menu toggle
    mobileMenu?.addEventListener('click', () => {
        sidebar.classList.add('active');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        gsap.fromTo(sidebar, 
            { x: -300 },
            { x: 0, duration: 0.3, ease: 'power3.out' }
        );
    });

    // Close sidebar
    function closeSidebarFunc() {
        gsap.to(sidebar, {
            x: -300,
            duration: 0.3,
            ease: 'power3.out',
            onComplete: () => {
                sidebar.classList.remove('active');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    }

    closeSidebar?.addEventListener('click', closeSidebarFunc);
    overlay?.addEventListener('click', closeSidebarFunc);

    // Sidebar item hover effects
    gsap.utils.toArray('.sidebar-item').forEach(item => {
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                x: 5,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                x: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}
function initQuickActions() {
    const quickActionBtns = document.querySelectorAll('.quick-action-btn');
    
    quickActionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Add click animation
            gsap.to(btn, {
                scale: 0.95,
                duration: 0.1,
                yoyo: true,
                repeat: 1,
                ease: 'power2.out'
            });
            
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.className = 'absolute inset-0 bg-white/10 rounded-lg pointer-events-none';
            btn.style.position = 'relative';
            btn.appendChild(ripple);
            
            gsap.fromTo(ripple,
                { scale: 0, opacity: 1 },
                { 
                    scale: 1, 
                    opacity: 0, 
                    duration: 0.4,
                    ease: 'power3.out',
                    onComplete: () => ripple.remove()
                }
            );
        });

        // Hover effect
        btn.addEventListener('mouseenter', () => {
            gsap.to(btn, {
                scale: 1.05,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, {
                scale: 1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}

function showAddModal(section,...args) {
    const modal = document.getElementById('universal-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');
    
    modalTitle.textContent = `Add New ${section.charAt(0).toUpperCase() + section.slice(1)} Item`;
    console.log(section);
    
    modalContent.innerHTML = generateAddForm(section,...args);
    // setLoading(true);
    
    modal.classList.remove('hidden');
    
    // Animate modal
    gsap.fromTo(modal, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
    );
    
    gsap.fromTo(modal.querySelector('.glass-card'), 
        { scale: 0.8, y: 50 },
        { scale: 1, y: 0, duration: 0.4, ease: 'back.out(1.7)' }
    );
}

async function editItem(type, item,...args) {
    const modal = document.getElementById('universal-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');
    
    modalTitle.textContent = `Edit ${type.charAt(0).toUpperCase() + type.slice(1)} #${item?.id ?? item}`;
    modalContent.innerHTML = await generateEditForm(type, item,...args);
    
    modal.classList.remove('hidden');
    
    // Animate modal
    gsap.fromTo(modal, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
    );
    
    gsap.fromTo(modal.querySelector('.glass-card'), 
        { scale: 0.8, y: 50 },
        { scale: 1, y: 0, duration: 0.4, ease: 'back.out(1.7)' }
    );
}

async function viewItem(type, item) {
    const modal = document.getElementById('universal-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');
    
    modalTitle.textContent = `View ${type.charAt(0).toUpperCase() + type.slice(1)} #${item?.id ?? item}`;
    modalContent.innerHTML = await generateViewContent(type, item);
    
    modal.classList.remove('hidden');
    
    // Animate modal
    gsap.fromTo(modal, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
    );
    
    gsap.fromTo(modal.querySelector('.glass-card'), 
        { scale: 0.8, y: 50 },
        { scale: 1, y: 0, duration: 0.4, ease: 'back.out(1.7)' }
    );
}

function deleteItem(type="services", id) {
    if (confirm(`Are you sure you want to delete this ${type}?`)) {
        // Add delete animation
        const row = event.target.closest('tr');
        gsap.to(row, {
            x: -100,
            opacity: 0,
            duration: 0.5,
            ease: 'power3.out',
            onComplete: () => {
            
                row.remove();
                showSuccessToast(`${type.charAt(0).toUpperCase() + type.slice(1)} requesting for delete.`, 'success');
            }
        });

        console.log(row, 'row deleted');
        return true
    }
    return false
}

function setLoading(status){
    const loading=document.getElementById('loading');
    const model=document.getElementById('modal-content');

    
    // setTimeout(() => {     
    //     loading.style.height=model?.scrollHeight + 'px';
    // }, 500);
    if(loading){
        if(status){
            loading.classList.remove('hidden');
        }
        else
        loading.classList.add('hidden');
    }
}
function showValidationErrors(errors = {}) {  
    const box = document.getElementById("errorBox");
  const list = document.getElementById("errorList");
  console.log(box);
  
  list.innerHTML = "";
    if(errors?.length>0 && Array?.isArray(errors)){


  errors.forEach((message) => {
    const li = document.createElement("li");
    li.innerHTML = `<i data-lucide="x-circle" class="inline w-4 h-4 mr-1 text-red-500"></i> ${message}`;
    list.appendChild(li);
  });

  box.classList.remove("hidden");
  lucide.createIcons();
return true
}
  else{
    box.classList.add("hidden");
return false

  }
 
}
     function showSuccessToast(message = 'Operation successful', toastType = 'success') {
            const toast = document.getElementById('successToast');
            const msgSpan = document.getElementById('successMessage');

            // Set the message
            msgSpan.textContent = message;
            toast?.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500');
            toast?.classList.add(`bg-${toastType=="success"?"green":toastType=="warning"?"yellow":"red"}-500`);
            // Make visible
            toast.classList.remove('hidden');

            // GSAP entry animation
            gsap.fromTo(toast, {
                opacity: 0,
                x: 100
            }, {
                opacity: 1,
                x: 0,
                duration: 0.6,
                ease: "power3.out"
            });

            // Hide after 3 seconds
            setTimeout(() => {
                gsap.to(toast, {
                    opacity: 0,
                    x: 100,
                    duration: 0.6,
                    onComplete: () => toast.classList.add('hidden')
                });
            }, 3000);
        }

function closeModal() {
    const modal = document.getElementById('universal-modal');
    
    gsap.to(modal.querySelector('.glass-card'), {
        scale: 0.8,
        y: 50,
        duration: 0.3,
        ease: 'power3.out'
    });
    
    gsap.to(modal, {
        opacity: 0,
        duration: 0.3,
        onComplete: () => {
            modal.classList.add('hidden');
        }
    });
}


async function handleLogout() {
  try {
    const res = await fetch('/api/auth/logout', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const result = await res.json();
    console.log('Logout response:', result);

    if (result?.status) {
        showSuccessToast("Logout Successfully!","success")
      // Redirect after logout
      window.location.href = '/dashboard/login';
    } else {
    //   alert(result?.message || 'Logout failed');
        showSuccessToast("Logout failed!","error")

    }

  } catch (err) {
    console.error('Logout error:', err);
        showSuccessToast("Logout failed!","error")

    // alert('An unexpected error occurred.');
  }
}

window.setLoading=setLoading;