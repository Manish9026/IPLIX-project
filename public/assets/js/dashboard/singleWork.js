gsap.registerPlugin(ScrollTrigger);

const generateAddForm = (type, ...args) => {

    try {
        console.log(type, args, type?.trim());
        const data = args[0] ?? null;
        const formHandleType = args[1] ?? null;

        const form = {
            "hero": `<form class="space-y-6" onsubmit="onHeroSave(event, 'hero')">
  <!-- Basic Fields -->
  <div>
    <label class="block text-sm font-medium mb-2">Category</label>
    <input type="text" name="category" class="w-full p-3 form-input rounded-lg text-white " placeholder="e.g. Technology">
  </div>

  <div>
    <label class="block text-sm font-medium mb-2">Title</label>
    <input type="text" name="title" class="w-full p-3 form-input rounded-lg text-white " placeholder="Tech Burner">
  </div>

  <div>
    <label class="block text-sm font-medium mb-2">Subtitle</label>
    <input type="text" name="subtitle" class="w-full p-3 form-input rounded-lg text-white " placeholder="Transforming a Tech Reviewer...">
  </div>

  <div class="flex space-x-4">
    <div class="flex-1">
      <label class="block text-sm font-medium mb-2">Duration</label>
      <input type="text" name="duration" class="w-full p-3 form-input rounded-lg text-white " placeholder="6 months">
    </div>
    <div class="flex-1">
      <label class="block text-sm font-medium mb-2">Team Size</label>
      <input type="number" name="team_size" class="w-full p-3 form-input rounded-lg text-white " placeholder="8">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-2">Hero Image</label>
    <input type="file" name="hero_image" class="w-full p-3 form-input rounded-lg text-white ">
  </div>

  <!-- Banner Media Upload -->
  <div>
    <label class="block text-sm font-medium mb-2">Banner Media (Image/Video)</label>
    <div class="flex items-center space-x-4 mb-2">
      <input type="file" multiple accept="image/*,video/*" onchange="addMedia(event, 'banner')" class="form-input p-2  text-white rounded">
      <button type="button" onclick="clearMedia('banner')" class="text-red-400 text-sm hover:underline">Clear All</button>
    </div>
    <div id="bannerPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-4"></div>
  </div>

  <!-- Card Media Upload -->
  <div>
    <label class="block text-sm font-medium mb-2">Card Media (Image/Video)</label>
    <div class="flex items-center space-x-4 mb-2">
      <input type="file" multiple accept="image/*,video/*" onchange="addMedia(event, 'card')" class="form-input p-2  text-white rounded">
      <button type="button" onclick="clearMedia('card')" class="text-red-400 text-sm hover:underline">Clear All</button>
    </div>
    <div id="cardPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-4"></div>
  </div>

  <!-- Action Buttons -->
  <div class="flex justify-end space-x-3">
    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg">Cancel</button>
    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg">Save</button>
  </div>
</form>
`,
            "challenge": `<form class="space-y-4" onsubmit="handleSubmit(event, 'challenge')">
  <div>
    <label class="block text-sm font-medium mb-2">Section Title</label>
    <input type="text" name="challenge_title" class="w-full p-3 form-input rounded-lg text-white" placeholder="The Challenge">
  </div>

  <div>
    <label class="block text-sm font-medium mb-2">Description</label>
    <textarea name="challenge_description" class="w-full p-3 form-input rounded-lg text-white h-24" placeholder="Explain the challenge..."></textarea>
  </div>

  <div class="flex justify-end space-x-3">
    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg">Cancel</button>
    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg">Save</button>
  </div>
</form>

`,

            "stats": `
        <form id="statForm" onsubmit="handleStatSubmit(event)" class="  rounded-xl  space-y-4  ">

        <input type="hidden" name="id"  value='${data?.id ?? ""}' id="id" class="hidden"/>

  <!-- Icon (Emoji or Symbol) -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Icon (emoji or symbol)</label>
    <input type="text" value='${data?.icon ?? ""}' name="icon" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 👥 or 🏆" required>
  </div>

  <!-- Value -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Value</label>
    <input type="text"  value='${data?.value ?? ""}' name="value" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 50+, 1000+" required>
  </div>

  <!-- Label -->
 <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Title</label>
    <input type="text"  value='${data?.title ?? ""}' name="title" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., About Stats Completed" required>
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Label</label>
    <input type="text"  value='${data?.label ?? ""}' name="label" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., Projects Completed" required>
  </div>

  <!-- Buttons -->
  <div class="flex justify-end space-x-2">
    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Clear</button>
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Add Stat</button>
  </div>
</form>

` ,
            "impact": `
<form 
  class="text-white" 
  onsubmit="handleImpactSubmit(event)" 
  enctype="multipart/form-data"
  data-work-id="WORK_ID_HERE">  <!-- Replace or set dynamically -->


  <!-- Title -->
  <div>
    <label class="block text-sm font-medium mb-2 text-gray-300">Section Title *</label>
    <input 
      type="text" 
      value='${data?.title ?? ""}'
      name="impact_title" 
      class="w-full p-3 form-input border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" 
      placeholder="e.g. The Impact"
      required
    >
  </div>

  <!-- Optional Subtitle -->
  <div>
    <label class="block text-sm font-medium mb-2 text-gray-300">Subtitle</label>
    <input 
      type="text" 
      name="impact_subtitle"
      value='${data?.subTitle ?? ""}' 
      class="w-full p-3 form-input border border-gray-700 rounded-lg" 
      placeholder="Optional short subtitle"
    >
  </div>

  <!-- Description -->
  <div>
    <label class="block text-sm font-medium mb-2 text-gray-300">Description</label>
    <textarea 
      name="impact_description" 
      rows="3" 

      class="w-full p-3 form-input border border-gray-700 rounded-lg resize-none" 
      placeholder="Optional detailed explanation...">
      ${data?.description}
      </textarea>
  </div>

  <!-- Bullet Points -->
  <div>
    <label class="block text-sm font-medium mb-2 text-gray-300">Bullet Points *</label>
    <textarea 
      name="impact_points" 
      class="w-full p-3 form-input border border-gray-700 rounded-lg resize-none h-32" 
      placeholder="One per line (e.g. Achieved 5x performance)\nImproved user engagement"
      required
    >${data?.points}</textarea>
  </div>

  <!-- Media Upload -->
  <div>
    <label class="block text-sm font-medium mb-2 text-gray-300">Impact Media (Images / Videos)</label>
    <div class="flex flex-wrap items-center gap-4 mb-3">
      <input 
        type="file" 
        name="impact_images" 
        accept="image/*,video/*" 
        multiple 
        onchange="addMedia(event, 'impact')" 
        class="form-input form-input text-white p-2 rounded-md border border-gray-700"
      >
      <button 
        type="button" 
        onclick="clearMedia('impact')" 
        class="text-red-400 text-sm hover:underline"
      >Clear All</button>
    </div>
    <div id="impactPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-4 transition-all">
    ${data && data?.media?.map(item => (

                `
        <img src='${window?.origin + '/' + item?.url}'  class="size-[100px] rounded-md"/>`

            )).join("")}
    </div>
  </div>

  <!-- Hidden ID field for update -->
  <input type="hidden" name="id" value="${data?.id}" />



  <!-- Submit Buttons -->
  <div class="flex justify-end gap-3 mt-4">
    <button 
      type="button" 
      onclick="closeModal()" 
      class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-sm"
    >Cancel</button>
    <button 
      type="submit" 
      class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-sm font-medium"
    >Save</button>
  </div>
</form>


`
        }

        return form[type?.trim()] ?? ""
    } catch (error) {
        console.log(error);

    }

}
function generateEditForm(type, data) {
    const form = {
        "hero": ``
    }

    return form[type] ?? ""
}
function generateViewContent(type, data) {
    const form = {
        "hero": ``
    }

    return form[type] ?? ""
}
function initialPage() {


    const listEl = document.getElementById("workListContainer");

}


let searchTimeout;
let bannerFiles = [];
let cardFiles = [];
let filsList = []
let workId = null;
let timeout=null;
const infoPage = `<div class="flex flex-col items-center justify-center text-center py-16 px-6 animate-fade-in space-y-6">
  
  <!-- Icon Section -->
  <div class="bg-slate-800/60 p-6 rounded-full border border-slate-700 shadow-lg shadow-indigo-700/10 animate-pulse">
    <i data-lucide="briefcase" class="w-12 h-12 text-indigo-400"></i>
  </div>

  <!-- Text Section -->
  <div class="max-w-xl space-y-2">
    <h2 class="text-2xl sm:text-3xl font-bold text-white">No Work Items Available</h2>
    <p class="text-gray-400 text-sm sm:text-base">
      You currently don't have any work entries. Try searching from the header using
      relevant <span class="font-semibold text-indigo-400">title</span> or <span class="font-semibold text-indigo-400">category</span>.
      <br class="hidden sm:block" />
      Or get started by creating a new work item now!
    </p>
  </div>

  <!-- Button Section -->
  <button onclick=" window.location.href = '/dashboard/work'; "
    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 transition-all px-5 py-3 rounded-lg text-sm font-medium">
    <i data-lucide="plus-circle" class="w-5 h-5"></i>
    Create New Work
  </button>
</div>`
async function handleWorkSearch(query) {

    const listEl = document.getElementById("workListContainer");
    listEl.classList.remove("hidden")
    listEl.innerHTML = '<li class="text-gray-400">Searching...</li>';
    console.log(query, encodeURIComponent(query));


    // Build query params
    const url = `../api/work?search=${encodeURIComponent(query)}`;

    try {
        const res = await fetch(url);
        const data = await res.json();

        if (!data.status || data.count === 0) {
            listEl.innerHTML = '<li class="text-red-400">No results found.</li>';
            return;
        }

        // Clear previous results
        listEl.innerHTML = '';

        // Render list
        data.data.forEach(item => {
            const li = document.createElement('li');
            li.className = 'bg-[#10193ea8] p-4 capitalize hover:opacity-70 cursor-pointer rounded-md shadow-md mb-2 border border-gray-700 text-white';
            li.innerHTML = `
        <h3 class="text-xl font-bold text-purple-400">${item.title}</h3>
        <p class="text-sm text-gray-300">Category: ${item.catTitle}</p>
        <p class="text-sm text-gray-500">ID: ${item.id}</p>
        <p class="text-sm mt-2">${item.subTitles || ''}</p>
      `;
            li.addEventListener("click", async () => {
                console.log("click",manageQueryParam({ action: 'get', key: 'id'}) );
                if(manageQueryParam({ action: 'get', key: 'id'}) !==item?.id){
                   manageQueryParam({ action: 'add', key: 'id', value: item?.id });
                await loadRenderedWorkSection(item?.id);    
                }
                
             
            });
            listEl.appendChild(li);
        });

    } catch (err) {
        console.error('Fetch error:', err);
        listEl.innerHTML = '<li class="text-red-400">Failed to fetch data.</li>';
    }
}


function searchWork(query) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        //    event.target.nextElementSibling.classList.remove('hidden')
        handleWorkSearch(query);
    }, 400); // Delay in ms
}
function onReset(event) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        event.target.nextElementSibling.classList.add('hidden')
    }, 400);
}



function addMedia(event, type) {
    const files = event.target.files;
    if (!files || !files.length) return;

    const previewContainer = document.getElementById(`${type}Preview`);
    const fileArray = type === 'banner' ? bannerFiles : type === 'card' ? cardFiles : filsList;

    for (const file of files) {
        const index = fileArray.length;
        fileArray.push(file);

        const wrapper = document.createElement('div');
        wrapper.className = 'relative rounded overflow-hidden shadow bg-black/40';

        const removeBtn = document.createElement('button');
        removeBtn.textContent = '✖';
        removeBtn.className = 'absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs';
        removeBtn.onclick = () => {
            fileArray.splice(index, 1);
            wrapper.remove();
        };

        let media;
        if (file.type.startsWith('image')) {
            media = document.createElement('img');
            media.src = URL.createObjectURL(file);
            media.className = 'w-full h-36 object-cover';
        } else if (file.type.startsWith('video')) {
            media = document.createElement('video');
            media.src = URL.createObjectURL(file);
            media.controls = true;
            media.className = 'w-full h-36 object-cover';
        }

        wrapper.appendChild(media);
        wrapper.appendChild(removeBtn);
        previewContainer.appendChild(wrapper);
    }

    // reset input
    event.target.value = '';
}

function clearMedia(type) {
    const previewContainer = document.getElementById(`${type}Preview`);
    previewContainer.innerHTML = '';
    if (type === 'banner') bannerFiles.length = 0;
    else if (type === 'card') cardFiles.length = 0;
}

// hero save handle submit
async function onHeroSave(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    // Extract input values
    const id = form.id?.value?.trim() ?? "";
    const title = form.title?.value?.trim();
    const category = form.category?.value?.trim();
    const subtitle = form.subtitle?.value?.trim();
    const duration = form.duration?.value?.trim();
    const teamSize = form.team_size?.value?.trim();

    // Validation
    const errors = [];
    if (!title || title.length < 2) errors.push("Title is required.");
    if (!category || category.length < 2) errors.push("Category is required.");

    if (showValidationErrors(errors)) return;

    console.log(cardFiles, bannerFiles);


    if (Array.isArray(bannerFiles) && bannerFiles?.length > 0) {
        for (let file of bannerFiles) {
            formData.append("bannerMedia[]", file);
        }
    }


    if (Array.isArray(cardFiles) && cardFiles?.length > 0) {
        for (let file of cardFiles) {
            formData.append("cardMedia[]", file);
        }
    }

    // Set loading and disable button
    const submitBtn = form.querySelector("button[type='submit']");
    submitBtn.disabled = true;
    setLoading(true);

    try {
        const response = await fetch("../api/work/manage/hero/save", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
            showValidationErrors(["Error: " + (result.message || "Unknown error")]);
        } else {
            showSuccessToast(result.message || "Hero section saved successfully!", "success");
            form.reset();
            closeModal(); // Optional: close modal after saving
            location.reload(); // Refresh to reflect changes
        }
    } catch (err) {
        console.error("Submit error:", err);
        alert("Something went wrong during submission.");
    } finally {
        setLoading(false);
        submitBtn.disabled = false;
    }
}


// work result in stats section handlers
async function handleStatSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    console.log(workId, formData
    );

    const icon = form.icon?.value?.trim();
    const value = form.value?.value?.trim();
    const label = form.label?.value?.trim();
    const title = form.title?.value?.trim();

    const statId = form.id?.value?.trim() ?? ""; // optional for update
    //   const workId = form.dataset.workId?.trim(); // get from form attribute
    console.log(statId, "id");

    const errors = [];
    if (!icon) errors.push("Icon is required.");
    if (!value) errors.push("Value is required.");
    if (!label) errors.push("Label is required.");
    if (!title) errors.push("Title is required.");

    if (!workId) errors.push("Work ID not found.");

    if (showValidationErrors(errors)) return;

    formData.append("workId", workId);
    formData.append("id", statId ? statId : ""); // for update

    try {
        form.querySelector("button[type='submit']").disabled = true;
        setLoading(true);

        const response = await fetch("../api/work/manage/stats/save", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
            showValidationErrors(["Error: " + (result.message || "Unknown error")]);
        } else {
            showSuccessToast(result.message || "Stat saved successfully", "success");
            form.reset();
            // location.reload(); // or manually re-render the updated stat list
        }
    } catch (err) {
        console.error("Stat submission error:", err);
        alert("Something went wrong.");
    } finally {
        setLoading(false);
        form.querySelector("button[type='submit']").disabled = false;
    }
}
async function handleStatDelete(statId) {
    if (!confirm("Are you sure you want to delete this stat?")) return;

    console.log(statId);

    const formData = new FormData();
    formData.append("id", statId);
    formData.append("workId", workId);

    try {
        setLoading(true);

        const response = await fetch("../api/work/manage/stats/delete", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Delete failed"), "error");
        } else {
            showSuccessToast(result.message || "Stat deleted successfully", "success");
            location.reload(); // or remove element from DOM manually
        }
    } catch (err) {
        console.error("Delete error:", err);
        alert("Something went wrong.");
    } finally {
        setLoading(false);
    }
}

// work impact sections 

async function handleImpactSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    const title = form.impact_title?.value?.trim();
    const pointsRaw = form.impact_points?.value?.trim();
    const subTitle = form.impact_subtitle?.value?.trim() ?? "";
    const description = form.impact_description?.value?.trim() ?? "";
    const impactId = form.id?.value?.trim() ?? ""; // optional
    // const workId = form.dataset.workId?.trim(); // from form attribute

    const errors = [];

    if (!title) errors.push("Impact title is required.");
    if (!pointsRaw) errors.push("Impact bullet points are required.");
    if (!workId) errors.push("Work ID not found.");

    if (showValidationErrors(errors)) return;

    if (Array.isArray(filsList) && filsList?.length > 0) {
        for (let file of filsList) {
            formData.append("impactMedia[]", file);
        }
    }

    console.log(formData);

    // Append additional fields
    formData.append("workId", workId);
    if (impactId) formData.append("id", impactId);

    try {
        form.querySelector("button[type='submit']").disabled = true;
        setLoading(true);

        const response = await fetch("../api/work/manage/impact/save", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
            showValidationErrors(["Error: " + (result.message || "Unknown error")]);
        } else {
            showSuccessToast(result.message || "Impact saved successfully ✅", "success");
            form.reset();
            // Optionally re-render impacts
        }
    } catch (err) {
        console.error("Impact submission error:", err);
        alert("Something went wrong.");
    } finally {
        setLoading(false);
        form.querySelector("button[type='submit']").disabled = false;
    }
}

async function handleDeleteImpact(impactId) {
    if (!confirm("Are you sure you want to delete this impact?")) return;

    const formData = new FormData();
    formData.append("workId", workId);
    formData.append("impactId", impactId);

    try {
        setLoading(true);

        const response = await fetch("../api/work/manage/impact/delete", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
        } else {
            showSuccessToast(result.message || "Impact deleted successfully 🗑", "success");
            document.querySelector(`#impact-${impactId}`)?.remove(); // Optional: DOM update
        }
    } catch (err) {
        console.error("Delete error:", err);
        alert("Something went wrong.");
    } finally {
        setLoading(false);
    }
}


'work_68685530d3acb'


async function loadRenderedWorkSection(id = "686933ed9cf2a") {
    const container = document.getElementById('workSection');

    try {
        const res = await fetch(`../api/work/dashboard/manage/${id}`);
        if (!res.ok) {
            // container.innerHTML = `<p class="text-red-400">Failed to load: ${res.statusText}</p>`;
            clearTimeout(timeout);
            setTimeout(() => {
                container.innerHTML=infoPage;
                lucide.createIcons(); 
            }, 400);
            return;
        }
        workId = "";
        workId = id;
        console.log(workId);

        const html = await res.text();
        container.innerHTML = html;
        cardScriptLoader();
    } catch (err) {
        container.innerHTML = `<p class="text-red-400">Error: ${err.message}</p>`;
    }
}
function manageQueryParam({ action, key, value = null } = {}) {
    const url = new URL(window.location.href);
    const params = url.searchParams;

    switch (action) {
        case 'add':
        case 'update':
            if (key && value !== null) {
                params.set(key, value);
                window.history.replaceState({}, '', url);
            }
            break;

        case 'remove':
            if (params.has(key)) {
                params.delete(key);
                window.history.replaceState({}, '', url);
            }
            break;

        case 'get':
            return params.get(key);

        default:
            console.warn('Unsupported action:', action);
    }
}


const initSwiper = () => {
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,


        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    new Swiper(".impact-slider", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,


        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    const cardSwiper = new Swiper(".card-swiper", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,

        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 4,
                spaceBetween: 40,
            }
        },

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    new Swiper(".challenge-slider", {
        spaceBetween: 16, // matches px-2 gap

        breakpoints: {
            0: {
                // slidesPerView: 1,
            },
            768: {
                // slidesPerView: 2,
            },
            1024: {
                // slidesPerView: 4,
            },
        },

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

function cardScriptLoader() {
    initSwiper();
    challengeAnimations();
    impactAnimation();

    gsap.utils.toArray('[data-stat]').forEach((card, index) => {
        gsap.fromTo(card,
            { opacity: 0, y: 30, scale: 0.9 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.8,
                ease: 'power3.out',
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse',
                    onEnter: () => animateCounter(card.querySelector('.counter'))
                }
            }
        );
    });
}







window.addEventListener('DOMContentLoaded', () => {


    // impactAnimation();
    // challengeAnimations();
    const id = manageQueryParam({ action: "get", key: "id" })
    console.log(id, "your id");

    loadRenderedWorkSection(id)
})
function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2;

    gsap.to({ value: 0 }, {
        value: target,
        duration: duration,
        ease: 'power2.out',
        onUpdate: function () {
            counter.textContent = Math.round(this.targets()[0].value) + '+';
        }
    });
}

function impactAnimation() {

    // Animate bullet points
    gsap.utils.toArray("#impactPoints li").forEach((el, i) => {
        gsap.to(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 80%",
            },
            x: 0,
            opacity: 1,
            duration: 0.6,
            delay: i * 0.1,
            ease: "power2.out",
        });
    });

    // Animate images
    gsap.utils.toArray("#impactImages div").forEach((img, i) => {
        gsap.to(img, {
            scrollTrigger: {
                trigger: img,
                start: "top 90%",
            },
            y: 0,
            opacity: 1,
            duration: 0.6,
            delay: i * 0.1,
            ease: "power2.out",
        });
    });
}
function challengeAnimations() {
    gsap.to("#challengeTitle", {
        scrollTrigger: {
            trigger: "#challengeView",
            start: "top 80%",
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: "power2.out",
    });

    gsap.to("#challengeDescription", {
        scrollTrigger: {
            trigger: "#challengeView",
            start: "top 85%",
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        delay: 0.2,
        ease: "power2.out",
    });
}