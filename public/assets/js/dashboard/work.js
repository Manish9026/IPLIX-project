
const generateAddForm = (formType) => {

    const form = {
        "project": `<form id="projectForm"
      onsubmit="handleProjectSubmit(event)"
      class="p-8 rounded-2xl   space-y-6 animate-fade-in w-full max-w-2xl mx-auto">

  <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-600 dark:text-blue-400">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Add New Project
  </h2>

  <!-- Title -->
  <div>
    <label class="block mb-2 text-sm font-medium">Title</label>
    <input type="text" name="title" class="form-input w-full p-3 rounded-lg" placeholder="Enter project title" required>
    <p class="text-red-500 text-xs hidden" id="error-title">Title is required.</p>
  </div>

  <!-- Description -->
  <div>
    <label class="block mb-2 text-sm font-medium">Description</label>
    <textarea name="description" rows="4" class="form-input w-full p-3 rounded-lg" placeholder="Enter description" required></textarea>
    <p class="text-red-500 text-xs hidden" id="error-description">Description is required.</p>
  </div>

  <!-- Category -->
  <div>
    <label class="block mb-2 text-sm font-medium">Category</label>
    <select onchange="hello(event)" id="categorySelect" name="categoryId" class="form-input bg-slate-800 w-full p-3 rounded-lg" required>
      <option disabled selected value="">Select a category</option>
      ${servicesData && Array.isArray(servicesData) && servicesData?.map((item) => {

            return `<option class="capitalize" data-category="${item?.title?.toLowerCase()}" value="${item?.id}">${item?.title?.toLowerCase()}</option>`
        })
            }
     
    </select>
    <p class="text-red-500 text-xs hidden" id="error-category">Please select a category.</p>
  </div>

  <!-- Tags -->
  <div>
    <label class="block mb-2 text-sm font-medium">Tags (comma-separated)</label>
    <input type="text" name="tags" class="form-input w-full p-3 rounded-lg" placeholder="e.g. Branding, Strategy" required>
  </div>




  <!-- Upload Image/Video OR Link -->
  <div>
  <label class="block mb-2 text-sm font-medium">Upload Images or Videos</label>

  <!-- File Upload -->
<input 
  type="file" 
  name="mediaFiles[]" 
  multiple 
  accept="image/*,video/*"
  class="form-input w-full p-2 rounded-lg text-sm"
  onchange="handleMediaSelect(event)"
>



  <!-- OR Paste URL -->
  <div class="mt-2 text-center text-xs text-gray-400">— or paste URL —</div>
  <input 
    type="url" 
    name="mediaUrl" 
    placeholder="https://example.com/media.jpg or .mp4"
    class="form-input w-full p-2 rounded-lg text-sm mt-2"
    oninput="previewMediaUrl(event)"
  >

  <!-- Previews -->
<div id="mediaPreviewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
</div>


  <!-- Buttons -->
  <div class="flex justify-end gap-4 pt-4">
    <button type="reset" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg text-white">Clear</button>
    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white">Add Project</button>
  </div>
</form>
`,
    }
    return form[formType] || '';
}
const generateEditForm = async (formType, itemId) => {

window.editingProjectId = itemId; 
    const response = await fetch(`../api/work/project/${itemId}`, {
        method: "GET",
    });
    if (!response.ok) throw new Error("Not found");
    const data =  (await response.json())?.data;

    console.log(data,data?.title );

    const form = {
        "project": `<form id="projectEditForm"
      onsubmit="handleProjectEdit(event)"
      class="p-8 rounded-2xl   space-y-6 animate-fade-in w-full max-w-2xl mx-auto">

  <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-600 dark:text-blue-400">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Add New Project
  </h2>

  <!-- Title -->
  <div>
    <label class="block mb-2 text-sm font-medium">Title</label>
    <input type="text" name="title" class="form-input w-full p-3 rounded-lg" value="${data?.title || "no titles"}" placeholder="Enter project title" required>
    <p class="text-red-500 text-xs hidden" id="error-title">Title is required.</p>
  </div>

  <!-- Description -->
  <div>
    <label class="block mb-2 text-sm font-medium">Description</label>
    <textarea name="description"  rows="4" class="form-input w-full p-3 rounded-lg" placeholder="Enter description" required>${data?.description ?? "no description"}</textarea>
    <p class="text-red-500 text-xs hidden" id="error-description">Description is required.</p>
  </div>

  <!-- Category -->
  <div>
    <label class="block mb-2 text-sm font-medium">Category</label>
    <select onchange="hello(event)"  id="categorySelect" name="categoryId" class="form-input bg-slate-800 w-full p-3 rounded-lg" required>
      <option disabled selected value="${data?.category?.categoryId}">${data?.category?.name}</option>

     
    </select>
    <p class="text-red-500 text-xs hidden" id="error-category">Please select a category.</p>
  </div>

  <!-- Tags -->
  <div>
    <label class="block mb-2 text-sm font-medium">Tags (comma-separated)</label>
    <input type="text" value="${data?.tags?.join(",")}" name="tags" class="form-input w-full p-3 rounded-lg" placeholder="e.g. Branding, Strategy" required>
  </div>




  <!-- Upload Image/Video OR Link -->
  <div>
  <label class="block mb-2 text-sm font-medium">Upload Images or Videos</label>

  <!-- File Upload -->
<input 
  type="file" 
  name="mediaFiles[]" 
  multiple 
  accept="image/*,video/*"
  class="form-input w-full p-2 rounded-lg text-sm"
  onchange="handleMediaSelect(event)"
>



  <!-- OR Paste URL -->
  <div class="mt-2 text-center text-xs text-gray-400">— or paste URL —</div>
  <input 
    type="url" 
    name="mediaUrl" 
    placeholder="https://example.com/media.jpg or .mp4"
    class="form-input w-full p-2 rounded-lg text-sm mt-2"
    oninput="previewMediaUrl(event)"
  >

  <!-- Previews -->
<div id="mediaPreviewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
</div>


  <!-- Buttons -->
  <div class="flex justify-end gap-4 pt-4">
    <button type="reset" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg text-white">Clear</button>
    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white">Edit Project</button>
  </div>
</form>`,
    }
    
    return form[formType] || '';
}

const generateViewContent = async(formType, itemId) => {
      const response = await fetch(`../api/work/project/${itemId}`, {
        method: "GET",
    });
    if (!response.ok) throw new Error("Not found");
    const data =  (await response.json())?.data;
    const content = {
       "project": `
        <div class="space-y-4">
          <div class="bg-gray-800/50 rounded-lg p-4">
            <h4 class="font-medium mb-2">Details for ${formType.charAt(0).toUpperCase() + formType.slice(1)} #${itemId}</h4>
            <div class="space-y-2 text-sm text-gray-300">
              <p><strong>Title:</strong> ${data?.title ?? 'No title'}</p>
               <p><strong>Category:</strong> ${data?.category?.name ?? 'No category'}</p>
               <p><strong>Tags:</strong> ${(Array?.isArray(data?.tags) && data?.tags?.join(",")) ?? 'No title'}</p>
               <p><strong>Total Projects:</strong> ${data?.category?.projectCount}</p>
              <p><strong>Status:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Active</span></p>
              <p><strong>Created:</strong> ${ data?.created_at	?? new Date().toLocaleDateString()}</p>
              <p><strong>Last Modified:</strong> ${data?.updated_at	?? new Date().toLocaleDateString()}</p>
            </div>
          </div>
          <div class="bg-gray-800/50 rounded-lg p-4">
            <h4 class="font-medium mb-2">Description</h4>
            <p class="text-gray-300 text-sm">${data?.description ?? "No description provided."}</p>
          </div>
        </div>`,
    }
    return content[formType] || '';
}

console.log(servicesData);

// PROJECT FROM JS 



let selectedFiles = [];

// Handle file selection
function handleMediaSelect(event) {
    const inputFiles = Array.from(event.target.files);
    selectedFiles.push(...inputFiles);
    renderMediaPreviews();
    // event.target.value = ''; // Allow reselecting same files
}

// Render preview and remove button
function renderMediaPreviews() {
    const container = document.getElementById("mediaPreviewContainer");
    container.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            const wrapper = document.createElement("div");
            wrapper.className = "relative border rounded-lg overflow-hidden group";

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.innerHTML = "✖";
            removeBtn.className = "absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center";
            removeBtn.onclick = () => {
                selectedFiles.splice(index, 1);
                renderMediaPreviews();
            };

            let media;
            if (file.type.startsWith("image")) {
                media = document.createElement("img");
                media.src = e.target.result;
                media.className = "w-full max-h-48 object-cover";
            } else if (file.type.startsWith("video")) {
                media = document.createElement("video");
                media.src = e.target.result;
                media.controls = true;
                media.className = "w-full max-h-48 object-cover";
            }

            wrapper.appendChild(media);
            wrapper.appendChild(removeBtn);
            container.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
}

// Use this when submitting the form to append files to FormData
function appendSelectedFilesToFormData(formData) {
    selectedFiles.forEach((file) => {
        formData.append('mediaFiles[]', file);
    });
}



function previewMediaFile(event) {
    const file = event.target.files[0];
    if (!file) return;

    const img = document.getElementById("mediaPreviewImage");
    const video = document.getElementById("mediaPreviewVideo");

    const reader = new FileReader();
    reader.onload = function (e) {
        if (file.type.startsWith("image")) {
            img.src = e.target.result;
            img.classList.remove("hidden");
            video.classList.add("hidden");
        } else if (file.type.startsWith("video")) {
            video.src = e.target.result;
            video.classList.remove("hidden");
            img.classList.add("hidden");
        }
    };
    reader.readAsDataURL(file);
}


function previewMediaUrl(event) {
    const container = document.getElementById("mediaPreviewContainer");
    container.innerHTML = '';

    const url = event.target.value.trim();
    if (!url) return;

    const isImage = /\.(jpg|jpeg|png|webp|gif)$/i.test(url) || url.startsWith("data:image/") || (url.startsWith("blob:") && url.includes("image"));
    const isVideo = /\.(mp4|webm|ogg)$/i.test(url) || url.startsWith("data:video/") || (url.startsWith("blob:") && url.includes("video"));

    let mediaElement;
    if (isImage) {
        mediaElement = document.createElement("img");
        mediaElement.src = url;
        mediaElement.className = "w-full max-h-48 object-cover rounded";
    } else if (isVideo) {
        mediaElement = document.createElement("video");
        mediaElement.src = url;
        mediaElement.controls = true;
        mediaElement.className = "w-full max-h-48 object-cover rounded";
    } else {
        const msg = document.createElement("p");
        msg.textContent = "Unsupported media format.";
        msg.className = "text-red-500 text-sm";
        container.appendChild(msg);
        return;
    }

    container.appendChild(mediaElement);

    // Create Blob/File instance
    fetch(url)
        .then(res => res.blob())
        .then(blob => {
            const extension = isImage ? "jpg" : "mp4"; // default
            const filename = `preview.${extension}`;
            const file = new File([blob], filename, { type: blob.type });

            // You can now use this `file` for upload or storage
            console.log("Generated File Instance:", file);

            // Optionally return or store it somewhere
            window.previewedFile = file; // or call a callback
        })
        .catch(err => {
            console.error("Failed to convert to File:", err);
        });
}







async function handleProjectSubmit(e) {
    e.preventDefault();
    const form = document.getElementById("projectForm");

    // Reset errors
    ["title", "description", "category"].forEach(id => {
        document.getElementById(`error-${id}`)?.classList.add("hidden");
    });

    // Validation
    let isValid = true;
    const requiredFields = ["title", "description", "categoryId"];
    for (let name of requiredFields) {
        const field = form[name];
        if (!field.value.trim()) {
            document.getElementById(`error-${name}`)?.classList.remove("hidden");
            isValid = false;
        }
    }
    if (!isValid) return;


    // Build form data
    const formData = new FormData(form);
    const selectItem = document.getElementById("categorySelect")?.selectedOptions[0]?.dataset;

    const newData = servicesData?.filter((i) => i?.id == formData.get("categoryId"))[0]

    formData.append("categoryTitle", selectItem?.category)
    formData.append("catDes", newData?.description);
    formData?.append("catIcon", newData?.icon)



    // Submit to API
    try {
        setLoading(true)
        const res = await fetch("../api/work/project/create", {
            method: "POST",
            body: formData
        });

        if (!res.ok) throw new Error("Failed to submit");

        const data = await res.json();
        console.log("✅ Submitted:", data);
        showSuccessToast("Project submitted!");
        setLoading(false)
        form.reset();
        // document.getElementById("mediaPreviewImage").classList.add("hidden");
        // document.getElementById("mediaPreviewVideo").classList.add("hidden");

    } catch (err) {
        setLoading(false)

        console.error("❌ Error:", err);
        showSuccessToast("❌ Something went wrong", "error");
    }
}


async function deleteWorkItem(formType, id) {
    console.log(formType, id);

    //   const confirmed = confirm("Are you sure you want to delete this project?");
    if (!deleteItem()) return;

    try {
        const response = await fetch(`../api/work/projects/delete/${id}`, {
            method: "DELETE",
        });

        const result = await response.json();
        if (result.status) {
            showSuccessToast(result?.message, "success")
        } else {

            showSuccessToast("failed deletion!", "error")
        }
    } catch (err) {


        showSuccessToast("Error deleting project.", "error")

    }
}

async function handleProjectEdit(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const projectId = window.editingProjectId; // ← set this globally when generating form
    if (!projectId) {
        alert("Project ID missing.");
        return;
    }

    try {
        const response = await fetch(`../api/work/project/edit/${projectId}`, {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok) {
            console.error(result);
            alert(result.message || "Something went wrong.");
            return;
        }

        alert("Project updated successfully!");
        // Optionally: close modal, refresh list
        window.location.reload();
    } catch (err) {
        console.error("Edit error:", err);
        alert("Failed to update project.");
    }
}

