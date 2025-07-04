window.addEventListener('DOMContentLoaded', () => {
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
})


const generateAddForm = (formType) => {

    const form = {
        "timeline": `<form class="space-y-4" onsubmit="timelineSubmit(event, 'story')">
                <div>
                    <label class="block text-sm font-medium mb-2">Year</label>
                    <input type="number" name="year" class="w-full p-3 form-input rounded-lg text-white" placeholder="2024">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Event Title</label>
                    <input type="text" name="title" class="w-full p-3 form-input rounded-lg text-white" placeholder="Milestone achieved">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" class="w-full p-3 form-input rounded-lg text-white h-24" placeholder="Describe the milestone"></textarea>
                </div>
              
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors">Add Event</button>
                </div>
            </form>`,

        "stats": `
        <form id="statForm" onsubmit="handleStatSubmit(event)" class="  rounded-xl  space-y-4  ">


  <!-- Icon (Emoji or Symbol) -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Icon (emoji or symbol)</label>
    <input type="text" name="icon" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 👥 or 🏆" required>
  </div>

  <!-- Value -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Value</label>
    <input type="text" name="value" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 50+, 1000+" required>
  </div>

  <!-- Label -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Label</label>
    <input type="text" name="label" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., Projects Completed" required>
  </div>

  <!-- Buttons -->
  <div class="flex justify-end space-x-2">
    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Clear</button>
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Add Stat</button>
  </div>
</form>

`    ,
        "team": `<form class="space-y-6" onsubmit="teamSubmit(event)" enctype="multipart/form-data" data-id="">
  <!-- Name -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Full Name</label>
    <input
      type="text"
      name="name"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., Alex Johnson"
      required
    />
  </div>

  <!-- Role -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Role</label>
    <input
      type="text"
      name="role"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., Creative Director"
      required
    />
  </div>

  <!-- Emoji -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Emoji</label>
    <input
      type="text"
      name="emoji"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., 👨‍💼"
      required
    />
  </div>

  <!-- Description -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Description</label>
    <textarea
      name="desc"
      class="form-text form-input  area w-full rounded-lg p-3  text-white"
      rows="4"
      placeholder="Brief description about the team member"
      required
    ></textarea>
  </div>

  <!-- Profile Picture -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Profile Picture</label>
    <input
      type="file"
      name="profilePic"
      accept="image/*"
      class="form-input w-full rounded-lg p-2  text-white"
      onchange="previewImage(event)"
    />
    <p class="text-xs text-gray-400 mt-1">Accepted formats: jpg, png (Max: 2MB)</p>

    <!-- Image preview -->
    <div id="imagePreview" class="mt-3 hidden relative w-fit">
      <img
        id="previewImg"
        src=""
        alt="Preview"
        class="rounded-lg border border-slate-700 w-32 h-32 object-cover"
      />
      <button
        type="button"
        onclick="removePreviewImage()"
        class="absolute top-0 right-0 bg-red-600 hover:bg-red-700 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center"
        title="Remove image"
      >
        &times;
      </button>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="flex justify-end">
    <button
      type="submit"
      class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-200"
    >
      <span id="submitBtnText">Add Member</span>
    </button>
  </div>

  <!-- Hidden ID (for update) -->
  <input type="hidden" name="id" />
</form>
`,
        "gallery": `
<form id="galleryForm" onsubmit="return handleGallerySubmit(event)" enctype="multipart/form-data" class="space-y-4">
  <input type="hidden" name="id" id="gallery-id" />

  <div>
    <label class="block mb-1 text-sm font-medium">Title</label>
    <input type="text" name="title" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Description</label>
    <textarea name="desc" name="desc" class="form-input w-full p-2 rounded bg-gray-800 text-white" required></textarea>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Alt Text</label>
    <input type="text" name="alt" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Visibility</label>
    <select name="hidden" class="form-select w-full bg-gray-800 text-white rounded p-2">
      <option value="false">Visible</option>
      <option value="true">Hidden</option>
    </select>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Upload Media (Image or Video)</label>
 <input 
    type="file" 
    name="media[]" 
    id="galleryMedia" 
    multiple 
    accept="image/*,video/*" 
    onchange="handleMediaChange(this)" 
    class="block mb-4"
  />

  </div>

  <div id="mediaPreview" class="grid grid-cols-2 gap-4 mb-4"></div>
  <div id="existing-preview" class="grid grid-cols-3 gap-4 mt-4"></div>

  <div class="text-right">
    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">Save</button>
  </div>
</form>

`
    }
    return form[formType] || '';
}
const generateEditForm = async (formType, data) => {

    console.log(window.origin, data?.id, data);
    if (formType === "gallery") {
        setTimeout(() => {

            populateGalleryForm(data);
        }, 1000);
    }

    const form = {
        "timeline": `
        <form data-id="${data?.id}" class="space-y-4" onsubmit="timelineSubmit(event, 'story')">
                    <div>
                        <label class="block text-sm font-medium mb-2">Year</label>
                        <input type="number" name="year" class="w-full p-3 form-input rounded-lg text-white" value="${data?.year}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Title</label>
                        <input type="text" name="title" class="w-full p-3 form-input rounded-lg text-white" value="${data?.title}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Description</label>
                        <textarea name="description" class="w-full p-3 form-input rounded-lg text-white h-24">${data?.description}</textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors">Add Event</button>
                </div>
                </form>
 
                `,

        "stats": `
        <form id="statForm" data-id="${data?.id}" onsubmit="handleStatSubmit(event)" class="  rounded-xl  space-y-4  ">


  <!-- Icon (Emoji or Symbol) -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Icon (emoji or symbol)</label>
    <input type="text" value="${data?.icon}" name="icon" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 👥 or 🏆" required>
  </div>

  <!-- Value -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Value</label>
    <input type="text" value="${data?.value}" name="value" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., 50+, 1000+" required>
  </div>

  <!-- Label -->
  <div>
    <label class="block text-sm font-medium text-gray-200 mb-1">Label</label>
    <input type="text" value="${data?.label}" name="label" class="form-input w-full p-3 rounded-lg bg-white/10 border border-gray-600 text-white" placeholder="e.g., Projects Completed" required>
  </div>

  <!-- Buttons -->
  <div class="flex justify-end space-x-2">
    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Clear</button>
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Add Stat</button>
  </div>
</form>

`,
        "team": `<form class="space-y-6" onsubmit="teamSubmit(event)" enctype="multipart/form-data" data-id="${data?.id}">
  <!-- Name -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Full Name</label>
    <input
      type="text"
      name="name"
      value="${data?.name}"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., Alex Johnson"
      required
    />
  </div>

  <!-- Role -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Role</label>
    <input
      type="text"
      name="role"
      value="${data?.role}"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., Creative Director"
      required
    />
  </div>

  <!-- Emoji -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Emoji</label>
    <input
      type="text"
      name="emoji"
      value="${data?.emoji}"
      class="form-input w-full rounded-lg p-3  text-white"
      placeholder="e.g., 👨‍💼"
      required
    />
  </div>

  <!-- Description -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Description</label>
    <textarea
      name="desc"
      class="form-text form-input  area w-full rounded-lg p-3  text-white"
      rows="4"

      placeholder="Brief description about the team member"
      required
    >${data?.desc}</textarea>
  </div>

  <!-- Profile Picture -->
  <div>
    <label class="block text-sm font-semibold mb-1 text-white">Change Profile Picture</label>
    <input
      type="file"
      name="profilePic"
      accept="image/*"
      class="form-input w-full rounded-lg p-2  text-white"
      onchange="previewImage(event)"
    />
    <p class="text-xs text-gray-400 mt-1">Accepted formats: jpg, png (Max: 2MB)</p>

    <!-- Image preview -->
    <div id="imagePreview" class="mt-3  relative w-fit">
      <img
        id="previewImg"
        src="${window?.origin + '/' + data?.profilePic}"
        alt="Preview"
        class="rounded-lg border border-slate-700 w-32 h-32 object-contain"
      />
      <button
        type="button"
        onclick="removePreviewImage()"
        class="absolute hidden top-0 right-0 bg-red-600 hover:bg-red-700 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center"
        title="Remove image"
      >
        &times;
      </button>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="flex justify-end">
    <button
      type="submit"
      class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-200"
    >
      <span id="submitBtnText">Update Member</span>
    </button>
  </div>

  <!-- Hidden ID (for update) -->
  <input type="hidden" name="id" />
</form>
`,
        // "gallery":`
        // <form id="galleryForm" onsubmit="handleGallerySubmit(event)" enctype="multipart/form-data" data-id="${data?.id ?? ""}" class="space-y-4">
        //   <input type="hidden" name="id" id="gallery-id" />

        //   <div>
        //     <label class="block mb-1 text-sm font-medium">Title</label>
        //     <input type="text" name="title" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
        //   </div>

        //   <div>
        //     <label class="block mb-1 text-sm font-medium">Description</label>
        //     <textarea name="desc" name="desc" class="form-input w-full p-2 rounded bg-gray-800 text-white" required></textarea>
        //   </div>

        //   <div>
        //     <label class="block mb-1 text-sm font-medium">Alt Text</label>
        //     <input type="text" name="alt" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
        //   </div>

        //   <div>
        //     <label class="block mb-1 text-sm font-medium">Visibility</label>
        //     <select name="hidden" class="form-select w-full bg-gray-800 text-white rounded p-2">
        //       <option value="false">Visible</option>
        //       <option value="true">Hidden</option>
        //     </select>
        //   </div>

        //   <div>
        //     <label class="block mb-1 text-sm font-medium">Upload Media (Image or Video)</label>
        //     <input type="file" name="media[]" accept="image/*,video/*" multiple class="w-full text-white bg-gray-900 p-2 rounded" />
        //   </div>

        //   <div id="existing-preview" class="grid grid-cols-3 gap-4 mt-4"></div>

        //   <div class="text-right">
        //     <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">Save</button>
        //   </div>
        // </form>

        // `

        "gallery": `
<form id="galleryForm" onsubmit="return handleGallerySubmit(event)" enctype="multipart/form-data" class="space-y-4">
  <input type="hidden" name="id" id="gallery-id" />

  <div>
    <label class="block mb-1 text-sm font-medium">Title</label>
    <input type="text" name="title" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Description</label>
    <textarea name="desc" name="desc" class="form-input w-full p-2 rounded bg-gray-800 text-white" required></textarea>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Alt Text</label>
    <input type="text" name="alt" class="form-input w-full p-2 rounded bg-gray-800 text-white" required>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Visibility</label>
    <select name="hidden" class="form-select w-full bg-gray-800 text-white rounded p-2">
      <option value="false">Visible</option>
      <option value="true">Hidden</option>
    </select>
  </div>

  <div>
    <label class="block mb-1 text-sm font-medium">Upload Media (Image or Video)</label>
 <input 
    type="file" 
    name="media[]" 
    id="galleryMedia" 
    multiple 
    accept="image/*,video/*" 
    onchange="handleMediaChange(this)" 
    class="block mb-4"
  />

  </div>

  <div id="mediaPreview" class="grid grid-cols-2 gap-4 mb-4"></div>
  <div id="existing-preview" class="grid grid-cols-3 gap-4 mt-4"></div>

  <div class="text-right">
    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">Save</button>
  </div>
</form>

`
    }
    return form[formType] || '';

}
const generateViewContent = (formType, data) => {

    const form = {
        "timeline": ` <div class="space-y-4">
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <h4 class="font-medium mb-2">Timeline Event Details</h4>
                            <div class="space-y-2 text-sm text-gray-300">
                                <p><strong>Year:</strong> <span class="text-${data?.accentColor}">${data?.year}</span></p>
                                <p><strong>Title:</strong> ${data?.title}</p>
                                <p><strong>Description:</strong> ${data?.description}</p>
                                <p><strong>Color:</strong> <span class="px-2 py-1 bg-${data?.accentColor}/20 text-${data?.accentColor} rounded-full text-xs">${data?.accentColor}</span></p>
                            </div>
                        </div>
                    </div>`,
        "stats": `
                <div class="space-y-4">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Details for ${formType?.charAt(0).toUpperCase() + formType.slice(1)} #${data?.id}</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p><strong>Title:</strong> Sample ${formType} title</p>
                            <p><strong>Status:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Active</span></p>
                            <p><strong>Created:</strong> ${new Date().toLocaleDateString()}</p>
                            <p><strong>Last Modified:</strong> ${new Date().toLocaleDateString()}</p>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Description</h4>
                        <p class="text-gray-300 text-sm">This is a sample description for ${formType} #${data?.id} It contains detailed information about the item and its purpose.</p>
                    </div>
                </div>
            `
    }
    return form[formType] || '';
}



async function timelineSubmit(event, type) {
    event.preventDefault();

    const form = event.target;

    const year = form.year.value.trim();
    const title = form.title.value.trim();
    const description = form.description.value.trim();
    const id = event?.target?.dataset?.id;

    // 1. Basic frontend validation
    const errors = [];

    if (!year || isNaN(year) || parseInt(year) < 1900 || parseInt(year) > 2100) {
        errors.push("Please enter a valid year.");
    }

    if (!title || title.length < 3) {
        errors.push("Title must be at least 3 characters.");
    }

    if (!description || description.length < 10) {
        errors.push("Description must be at least 10 characters.");
    }

    console.log(errors);

    if (showValidationErrors(errors)) return

    form.querySelector("button[type='submit']").disabled = true;


    // 3. Prepare form data
    const formData = new FormData();
    formData.append("year", year);
    formData.append("title", title);
    formData.append("description", description);
    formData.append("color", "blue-400");
    formData.append("id", id ?? "");


    try {
        // 4. API call
        setLoading(true)
        const response = await fetch("../api/story/timeline", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (!response.ok) {
            const msg = result?.message || "Something went wrong!";
            const errList = result?.errors
                ? Object.values(result.errors).join("\n")
                : msg;

            showSuccessToast(errList, "error")
            alert("Error:\n" + errList);
        } else {
            showSuccessToast(result?.message ?? "Event added successfully!", "success")
            form.reset();
            closeModal();
        }
    } catch (error) {

        showSuccessToast(error.message ?? "Unexpected error:", "success")

    } finally {

        form.querySelector("button[type='submit']").disabled = false;
        setLoading(false)

    }
}
async function timelineDelete(type, id) {

    if (!deleteItem()) return;

    try {
        const response = await fetch(`../api/story/timeline/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (response.ok && result.status) {
            showSuccessToast(result?.message ?? "Deleted successfully!")
            location.reload();
        } else {

            showSuccessToast(result?.message ?? "Failed to delete.", "error");
            console.error(result);
        }

    } catch (error) {
        console.error("Error deleting item:", error);
        showSuccessToast(result?.message ?? "Error deleting item:", "error");
    }
}
// functions of stats manages 

async function handleStatSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const id = form?.dataset?.id || "";

    // 1. Read input values
    const icon = form.icon.value.trim();
    const value = form.value.value.trim();
    const label = form.label.value.trim();

    // 2. Frontend validation
    const errors = [];

    if (!icon || icon.length < 1) {
        errors.push("Icon is required (e.g. 👥 or 🏆).");
    }

    if (!value || value.length < 1) {
        errors.push("Value is required (e.g. 50+).");
    }

    if (!label || label.length < 3) {
        errors.push("Label must be at least 3 characters.");
    }

    if (showValidationErrors(errors)) return;

    // Disable submit button
    form.querySelector("button[type='submit']").disabled = true;

    // 3. Prepare FormData
    const formData = new FormData();
    formData.append("icon", icon);
    formData.append("value", value);
    formData.append("label", label);
    if (id) formData.append("id", id);

    try {
        // 4. Make API call
        setLoading(true);

        const response = await fetch("../api/story/stats", {
            method: "POST",
            body: formData,
        });

        const result = await response.json();

        if (!response.ok) {
            const msg = result?.message || "Something went wrong!";
            const errList = result?.errors
                ? Object.values(result.errors).join("\n")
                : msg;

            showSuccessToast(errList, "error");
        } else {
            showSuccessToast(result?.message ?? "Stat saved successfully!", "success");
            form.reset();
            closeModal();
        }
    } catch (error) {
        showSuccessToast(error.message ?? "Unexpected error", "error");
    } finally {
        form.querySelector("button[type='submit']").disabled = false;
        setLoading(false);
    }
}
async function statDelete(id) {
    // Confirmation prompt
    if (!confirm("Are you sure you want to delete this stat?")) return;
    try {
        // API call
        const response = await fetch(`../api/story/stats/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (response.ok && result.status) {
            showSuccessToast(result.message ?? "Stat deleted successfully!");
            location.reload(); // refresh table or UI
        } else {
            showSuccessToast(result.message ?? "Failed to delete stat.", "error");
            console.error("Delete failed:", result);
        }

    } catch (error) {
        console.error("Delete error:", error);
        showSuccessToast("Error deleting stat", "error");
    }
}

// functions of team member 
function previewImage(event) {
    const fileInput = event.target;
    const previewBox = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewBox.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removePreviewImage() {
    const input = document.querySelector("input[name='profilePic']");
    input.value = ""; // Reset file input
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('previewImg').src = "";
}

async function teamSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const id = form.dataset.id || ""; // for update

    const name = form.name.value.trim();
    const role = form.role.value.trim();
    const desc = form.desc.value.trim();
    const emoji = form.emoji.value.trim();
    //   const color = form.color.value.trim();
    //   const textColor = form?.textColor?.value.trim();
    const profilePic = form.profilePic?.files?.[0];

    // 🔍 Validation
    const errors = [];

    if (!name || name.length < 3) errors.push("Name must be at least 3 characters.");
    if (!role) errors.push("Role is required.");
    if (!desc || desc.length < 10) errors.push("Description must be at least 10 characters.");
    if (!emoji) errors.push("Emoji is required.");
    //   if (!color || !textColor) errors.push("Both gradient color and text color are required.");

    if (errors.length > 0) {
        showValidationErrors(errors);
        return;
    }

    // Disable submit button
    const submitBtn = form.querySelector("button[type='submit']");
    submitBtn.disabled = true;
    setLoading(true);

    // 🧾 Prepare FormData
    const formData = new FormData();
    formData.append("name", name);
    formData.append("role", role);
    formData.append("desc", desc);
    formData.append("emoji", emoji);
    //   formData.append("color", color);
    //   formData.append("textColor", textColor);
    if (profilePic) {
        formData.append("profilePic", profilePic);
    }
    formData.append("id", id);

    try {
        // 📡 API Call
        const response = await fetch("../api/story/teams", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            const msg = result?.message || "Something went wrong!";
            const errList = result?.errors
                ? Object.values(result.errors).join("\n")
                : msg;

            showSuccessToast(errList, "error");
            console.error("Error:", errList);
        } else {
            showSuccessToast(result.message || "Team member saved successfully!", "success");
            form.reset();
            closeModal();
            location.reload();
        }
    } catch (error) {
        showSuccessToast("Unexpected error: " + error.message, "error");
        console.error("Submit error:", error);
    } finally {
        submitBtn.disabled = false;
        setLoading(false);
    }
}

// function for gallery

// Global media storage
let selectedMedia = [];
let removedMedia = [];

function populateGalleryForm(data = {}) {
    const form = document.getElementById('galleryForm');
    form.reset();
    removedMedia = [];
    form.id.value = data.id || '';
    form.title.value = data.title || '';
    form.desc.value = data.desc || '';
    form.alt.value = data.alt || '';
    form.hidden.value = data.hidden ? "true" : "false";

    const preview = document.getElementById('existing-preview');
    preview.innerHTML = '';

    if (Array.isArray(data.media)) {
        data.media.forEach(media => {
            const wrapper = document.createElement('div');
            wrapper.className = "relative";

            let previewEl;
            if (media.type === 'image') {
                previewEl = `<img src="../${media.url}" class="w-full h-28 object-cover rounded border" />`;
            } else if (media.type === 'video') {
                previewEl = `<video src="../${media.url}" class="w-full h-28 rounded border" controls></video>`;
            }

            wrapper.innerHTML = `
        ${previewEl}
        <button type="button" class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1 py-0.5" onclick="editRemoveMedia('${media.url}', this)">×</button>
      `;

            preview.appendChild(wrapper);
        });
    }
}

function editRemoveMedia(url, btn) {
    removedMedia.push(url);
    btn.parentElement.remove();
}

async function handleGallerySubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const id = form.id.value?.trim() ?? "";
    const title = form.title.value?.trim();
    const alt = form.alt.value?.trim();
    const desc = form.desc.value?.trim();

    console.log(id);


    // Basic validation
    const errors = [];
    if (!title || title.length < 3) errors.push("Title must be at least 3 characters.");
    if (!desc || desc.length < 5) errors.push("Description is too short.");
    if (!alt) errors.push("Alt text is required.");
    if (!id && selectedMedia.length === 0) errors.push("At least one image or video is required.");

    if (showValidationErrors(errors)) return;
    formData.append("removeMedia", JSON.stringify(removedMedia));
    selectedMedia.forEach(file => formData.append("media[]", file));

    console.log(formData);

    try {
        form.querySelector("button[type='submit']").disabled = true;
        setLoading(true);
        const response = await fetch('../api/story/gallery', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (!response.ok || !result.status) {
            showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
            showValidationErrors(["Error: " + (result.message || "Unknown error")])
        } else {

            showSuccessToast(result.message || "Saved successfully!", "success");
            setLoading(false);
            form.reset();
            removedMedia = [];
            selectedMedia = [];
            location.reload();
        }
    } catch (error) {
        console.error("Submission failed:", error);
        alert("Error submitting form.");
    } finally {
        setLoading(false);
        form.querySelector("button[type='submit']").disabled = false;
    }
}
async function galleryDelete(type, id) {

    console.log(id);

    // Confirm before deletion
    if (!confirm("Are you sure you want to delete this gallery item?")) return;

    try {
        const response = await fetch(`../api/story/gallery/${id}`, {
            method: 'DELETE',
            headers: { Accept: 'application/json' }
        });

        const result = await response.json();

        if (response.ok && result.status) {
            showSuccessToast(result?.message ?? "Gallery item deleted successfully!");
            location.reload();
        } else {
            showSuccessToast(result?.message ?? "Failed to delete gallery item.", "error");
            console.log(result);
        }

    } catch (error) {
        console.error("Error deleting gallery item:", error);
        showSuccessToast(error?.message ?? "Unexpected error occurred during deletion.", "error");
    }
}




function handleMediaChange(input) {
    const files = Array.from(input.files);
    files.forEach(file => selectedMedia.push(file));
    input.value = ''; // Reset input so it can be reused
    updateMediaPreview();
}
function removeMedia(index) {
    selectedMedia.splice(index, 1);
    updateMediaPreview();
}
function updateMediaPreview() {
    const container = document.getElementById('mediaPreview');
    container.innerHTML = '';

    selectedMedia.forEach((file, index) => {
        const fileType = file.type.split('/')[0]; // image or video
        const wrapper = document.createElement('div');
        wrapper.className = 'relative';

        const reader = new FileReader();

        reader.onload = (e) => {
            if (fileType === 'image') {
                wrapper.innerHTML = `
          <img src="${e.target.result}" class="w-full h-28 object-cover rounded border" />
          <button type="button" onclick="removeMedia(${index})" class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1 py-0.5">×</button>
        `;
            } else if (fileType === 'video') {
                wrapper.innerHTML = `
          <video src="${e.target.result}" class="w-full h-28 rounded border" controls></video>
          <button type="button" onclick="removeMedia(${index})" class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1 py-0.5">×</button>
        `;
            }

            container.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
}




// animations
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