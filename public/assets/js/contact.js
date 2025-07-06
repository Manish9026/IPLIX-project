// GSAP Animations for Contact Page
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', function () {
    initContactAnimations();
    initServiceSeectionAnimation()
    initFormInteractions();
    // initNavigation();
    initMagneticEffects();

    setTimeout(() => {
        const contact = document.getElementById("contact");
        if (contact) {
            gsap.to(window, {
                duration: 1.5,
                scrollTo: {
                    y: contact,
                    offsetY: 160
                },
                ease: 'power2.inOut'
            });
            // window.scrollTo({
            //   top: contact.offsetTop - 100,
            //   behavior: "smooth"
            // });
            console.log("Scrolled to:", contact);
        } else {
            console.warn("❗️#contact not found.");
        }
    }, 2000);
});





function initContactAnimations() {
    // Hero animations
    const heroTl = gsap.timeline();

    heroTl.fromTo('.hero-title',
        {
            opacity: 0,
            y: 100,
            rotationX: 90,
            transformOrigin: 'center bottom'
        },
        {
            opacity: 1,
            y: 0,
            rotationX: 0,
            duration: 1.5,
            ease: 'power3.out'
        }
    )
        .fromTo('.hero-subtitle',
            { opacity: 0, y: 50 },
            { opacity: 1, y: 0, duration: 1, ease: 'power3.out' },
            '-=0.8'
        );

    // Floating icons animation
    gsap.utils.toArray('.floating-icon').forEach((icon, index) => {
        gsap.set(icon, {
            opacity: 0,
            scale: 0,
            rotation: Math.random() * 360
        });

        gsap.to(icon, {
            opacity: 0.6,
            scale: 1,
            rotation: 0,
            duration: 1,
            delay: index * 0.2,
            ease: 'back.out(1.7)'
        });

        // Continuous floating animation
        gsap.to(icon, {
            y: -30,
            rotation: 360,
            duration: 4 + Math.random() * 2,
            repeat: -1,
            yoyo: true,
            ease: 'power2.inOut',
            delay: Math.random() * 2
        });
    });

    // Contact info section
    gsap.fromTo('.contact-info',
        { opacity: 0, x: -100, rotationY: 20 },
        {
            opacity: 1,
            x: 0,
            rotationY: 0,
            duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.contact-info',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Contact items animation
    gsap.utils.toArray('.contact-item').forEach((item, index) => {
        gsap.fromTo(item,
            {
                opacity: 0,
                y: 60,
                rotationX: 45,
                scale: 0.8
            },
            {
                opacity: 1,
                y: 0,
                rotationX: 0,
                scale: 1,
                duration: 0.8,
                ease: 'power3.out',
                delay: index * 0.15,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            }
        );

        // Hover animations for contact items
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                scale: 1.05,
                rotationY: 5,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                scale: 1,
                rotationY: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Contact form animation
    gsap.fromTo('.contact-form',
        { opacity: 0, x: 100, scale: 0.9 },
        {
            opacity: 1,
            x: 0,
            scale: 1,
            duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.contact-form',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );

    // Form elements animation
    gsap.utils.toArray('.form-group').forEach((group, index) => {
        gsap.fromTo(group,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                delay: index * 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: group,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // Map section animation
    gsap.fromTo('.map-section',
        { opacity: 0, y: 80, scale: 0.9 },
        {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.map-section',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        }
    );



}

function initServiceSeectionAnimation() {

    gsap.from(".service-item", {
        opacity: 0,
        y: 40,
        duration: 0.8,
        stagger: 0.15,
        ease: "power2.out"
    });

    gsap.from("h2", {
        opacity: 0,
        x: -50,
        duration: 1.2,
        ease: "power2.out"
    });
    document.querySelectorAll('.service-item').forEach(btn => {
        btn.addEventListener('mouseenter', (e) => {
            gsap.to(btn, {
                scale: 1.1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mouseleave', (e) => {
            gsap.to(btn, {
                scale: 1,
                x: 0,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });
}

function initFormInteractions() {
    const form = document.getElementById('contactForm');
    const inputs = document.querySelectorAll('.form-control');
    const submitBtn = document.querySelector('.submit-btn');

    // Input focus animations
    inputs.forEach(input => {
        input.addEventListener('focus', (e) => {
            gsap.to(e.target, {
                scale: 1.02,
                duration: 0.3,
                ease: 'power2.out'
            });

            gsap.to(e.target.previousElementSibling, {
                color: '#667eea',
                scale: 1.1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        input.addEventListener('blur', (e) => {
            gsap.to(e.target, {
                scale: 1,
                duration: 0.3,
                ease: 'power2.out'
            });

            gsap.to(e.target.previousElementSibling, {
                color: 'rgba(255, 255, 255, 0.8)',
                scale: 1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        // Typing animation
        input.addEventListener('input', (e) => {
            if (e.target.value.length > 0) {
                gsap.to(e.target, {
                    borderColor: '#667eea',
                    boxShadow: '0 0 20px rgba(102, 126, 234, 0.3)',
                    duration: 0.3
                });
            } else {
                gsap.to(e.target, {
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    boxShadow: 'none',
                    duration: 0.3
                });
            }
        });
    });

    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        const id = form.id?.value?.trim();
        const name = form.name?.value?.trim();
        const email = form.email?.value?.trim();
        const service = form.service?.value?.trim();
        const mobNo = form.mobNo?.value?.trim();
        const message = form.message?.value?.trim();

        const errors = [];

        const buttonCache=submitBtn?.innerHTML;


        if (!name || name.length < 2) errors.push("Client name is required.");
        if (!email || !/\S+@\S+\.\S+/.test(email)) errors.push("Valid email is required.");
        if (!message || message.length < 5) errors.push("Message must be at least 5 characters.");

        if (showValidationErrors(errors)) return;
        submitBtn.innerHTML="";
        submitBtn.innerHTML=`<i data-lucide="loader-circle" class="w-5 h-5 animate-spin"></i> Sending...`
        lucide.createIcons();
        formData.append("id", id?id:"");
        console.log(formData);
        
        try {
            submitBtn.disabled = true;

            const res = await fetch("../api/contact/clients/save", {
                method: "POST",
                body: formData
            });

            const result = await res.json();

            if (!res.ok || !result.status) {
                showValidationErrors([result.message || "Client save failed."]);
            } else {

                    gsap.to(submitBtn, {
            scale: 0.95,
            duration: 0.1,
            yoyo: true,
            repeat: 1,
            onComplete: () => {
                // Show success message
                const successMsg = document.createElement('div');
                successMsg.innerHTML = `
                    <div style="
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 2rem;
                        border-radius: 15px;
                        text-align: center;
                        z-index: 10000;
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                    ">
                        <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h3>Message Sent Successfully!</h3>
                        <p>We'll get back to you within 24 hours.</p>
                    </div>
                `;
                document.body.appendChild(successMsg);

                gsap.fromTo(successMsg.firstElementChild,
                    { opacity: 0, scale: 0.5, rotationY: 180 },
                    { opacity: 1, scale: 1, rotationY: 0, duration: 0.8, ease: 'back.out(1.7)' }
                );

                setTimeout(() => {
                    gsap.to(successMsg.firstElementChild, {
                        opacity: 0,
                        scale: 0.5,
                        duration: 0.5,
                        onComplete: () => {
                            document.body.removeChild(successMsg);
                            form.reset();
                        }
                    });
                }, 3000);
            }
        });

            }

        } catch (err) {
            console.error("Save Error:", err);
            alert("An unexpected error occurred.");
        } finally {
            submitBtn.innerHTML=buttonCache;
            submitBtn.disabled = false;
        }



        // Success animation
    
    });
}

// function initNavigation() {
//     const navbar = document.getElementById('navbar');

//     window.addEventListener('scroll', () => {
//         if (window.scrollY > 50) {
//             navbar.classList.add('scrolled');
//         } else {
//             navbar.classList.remove('scrolled');
//         }
//     });
// }

function initMagneticEffects() {
    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mouseenter', (e) => {
            gsap.to(btn, {
                scale: 1.1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mouseleave', (e) => {
            gsap.to(btn, {
                scale: 1,


                x: 0,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Pulse animation for contact icons
    gsap.utils.toArray('.pulse-animation').forEach(icon => {
        gsap.to(icon, {
            scale: 1.2,
            duration: 1,
            repeat: -1,
            yoyo: true,
            ease: 'power2.inOut',
            transformOrigin: 'center center' ,
             
        });
    });
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
// Parallax effect for floating icons
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = scrolled * 0.5;

    gsap.utils.toArray('.floating-icon').forEach((icon, index) => {
        const speed = 0.5 + (index * 0.1);
        gsap.to(icon, {
            y: parallax * speed,
            duration: 0.1,
            ease: 'none'
        });
    });
});
