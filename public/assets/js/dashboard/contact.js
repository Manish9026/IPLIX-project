const generateAddForm = (formType) => {

    const form = {
        "company": `<form id="contactCompanyForm" onsubmit="onCompanySave(this)" class=" p-6 rounded-xl  space-y-5 w-full ">
  <!-- Company Logo -->

  <div id="logoUploadWrapper" class="space-y-2">
  <label for="logoInput" class="block font-medium text-sm ">Company Logo</label>

  <!-- Hidden file input -->
  <input type="file" onchange="onFileChange(this)" accept="image/*" id="logoInput" class="hidden" />

  <!-- Upload Button -->
  <button type="button" onclick="document.getElementById('logoInput').click()"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Upload Logo
  </button>

  <!-- Preview -->
  <div id="logoPreviewContainer" class="mt-3 hidden relative w-40">
    <img id="logoPreview" src="" alt="Logo Preview" class="rounded shadow w-full h-auto" />
    <button type="button" onclick="removeLogoPreview()"
      class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700">
      &times;
    </button>
  </div>

  <!-- Hidden input to store uploaded image base64 or URL -->
  <input type="hidden" name="logo" id="logo" />
</div>


  <!-- Company Name -->
  <div>
    <label for="name" class="block font-medium text-sm ">Company Name <span class="text-red-500">*</span></label>
    <input type="text" name="name" id="name"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="TechCorp" required />
  </div>

  <!-- Subtitle -->
  <div>
    <label for="subTitle" class="block font-medium text-sm ">Subtitle</label>
    <input type="text" name="subTitle" id="subTitle"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Empowering Digital Growth" />
  </div>

    <div>
    <label for="address" class="block font-medium text-sm ">Company Address <span class="text-red-500">*</span></label>
    <textarea name="address" id="address" rows="4"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Brief about the company address..." required></textarea>
  </div>

  <!-- Description -->
  <div>
    <label for="description" class="block font-medium text-sm ">Description <span class="text-red-500">*</span></label>
    <textarea name="description" id="description" rows="4"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Brief about the company..." required></textarea>
  </div>

  <!-- Submit Button -->
  <div class="text-right">
    <button type="submit"
      class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-semibold">
      Save Company Info
    </button>
  </div>
</form>
`,
"contact":`<form id="contactForm" onsubmit="onContactSave(event)" class="space-y-6 ">
  <input type="hidden" name="id" id="contactId" />

  <div>
    <label class="block font-medium mb-1">Title <span class="text-red-500">*</span></label>
    <input type="text" name="title" id="contactTitle" required class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. Visit Us" />
  </div>

  <div>
    <label class="block font-medium mb-1">Icon (Font Awesome Class)</label>
    <input type="text" name="icon" id="contactIcon" class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. fas fa-map-marker-alt" />
  </div>

  <div>
    <label class="block font-medium mb-1">Value <span class="text-red-500">*</span></label>
    <input type="text" name="value" id="contactValue" required class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. 123 Tech Street, NY" />
  </div>

  <div>
    <label class="block font-medium mb-1">Description</label>
    <textarea name="description" id="contactDescription" rows="3" class="form-input w-full border px-4 py-2 rounded-md" placeholder="Optional details..."></textarea>
  </div>

  <div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-all">
      💾 Save Contact Info
    </button>
  </div>
</form>
`,
"social":`<form id="socialForm" onsubmit="onSocialSave(event)" class="space-y-4 ">

  <!-- Hidden ID for edit -->
  <input type="hidden" name="id" id="socialId">

  <!-- Title -->
  <div>
    <label class="block font-semibold mb-1" for="title">Platform Name *</label>
    <input type="text" name="title" id="title" class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. Facebook" required>
  </div>

  <!-- Link -->
  <div>
    <label class="block font-semibold mb-1" for="link">Profile URL</label>
    <input type="url" name="link" id="link" class="form-input w-full border px-4 py-2 rounded-md" placeholder="https://facebook.com/yourpage">
  </div>

  <!-- Icons -->
  <div>
    <label class="block font-semibold mb-1" for="icons">FontAwesome Icon Class *</label>
    <input type="text" name="icons" id="icons" class="form-input w-full border px-4 py-2 rounded-md" placeholder="fab fa-facebook" required>
  </div>

  <!-- Color Picker + Manual -->
  <div>
    <label class="block font-semibold mb-1">Icon Color</label>
    <div class="flex items-center gap-3">
      <input type="color" id="colorPicker" class="w-10 h-10 p-0 border-0 rounded cursor-pointer" onchange="document.getElementById('color').value = this.value">
      <input type="text" name="color" id="color" class="flex-1 form-input w-full border px-4 py-2 rounded-md" placeholder="#4267B2"
             oninput="document.getElementById('colorPicker').value = this.value">
    </div>
  </div>

  <!-- Is Link -->
  <div>
    <label class="block font-semibold mb-1" for="isLink">Is Clickable Link</label>
    <select name="isLink" id="isLink" class="form-input w-full border px-4 py-2 rounded-md">
      <option class="bg-slate-200 text-gray-800" value="1" selected>Yes</option>
      <option value="0" class="bg-slate-200 text-gray-800">No</option>
    </select>
  </div>

  <!-- Submit Button -->
  <div class="text-right">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow transition">
      💾 Save Social Link
    </button>
  </div>
</form>
`
    }
    return form[formType] || '';
}
const generateEditForm = (formType, data) => {

    console.log(data);
    
    const form = {
        "company": `<form id="contactCompanyForm" data-id="${data?.id}" onsubmit="onCompanySave(event)" class=" p-6 rounded-xl  space-y-5 w-full ">
  <!-- Company Logo -->

  <div id="logoUploadWrapper" class="space-y-2">
  <label for="logoInput" class="block font-medium text-sm ">Company Logo</label>

  <!-- Hidden file input -->
  <input type="file" onchange="onFileChange(this)" accept="image/*" id="logoInput" class="hidden" name="logo"  />

  <!-- Upload Button -->
  <button type="button" onclick="document.getElementById('logoInput').click()"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Change Logo
  </button>

  <!-- Preview -->
  <div id="logoPreviewContainer" class="mt-3 ${data?.logo?"":"hidden"} relative w-40">
    <img id="logoPreview" src="${window.origin + '/'+data?.logo}" alt="Logo Preview" class=" rounded shadow w-full h-auto" />
    <button type="button" onclick="removeLogoPreview()"
      class="absolute ${data?.logo?"hidden":""}  -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700">
      &times;
    </button>
  </div>

  <!-- Hidden input to store uploaded image base64 or URL -->
  <!--<input type="hidden" name="logo" id="logo" />-->
</div>


  <!-- Company Name -->
  <div>
    <label for="name" class="block font-medium text-sm ">Company Name <span class="text-red-500">*</span></label>
    <input type="text" value="${data?.name}" name="name" id="name"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="TechCorp" required />
  </div>

  <!-- Subtitle -->
  <div>
    <label for="subTitle" class="block font-medium text-sm ">Subtitle</label>
    <input type="text" value="${data?.subTitle}" name="subTitle" id="subTitle"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Empowering Digital Growth" />
  </div>

    <div>
    <label for="address" class="block font-medium text-sm ">Company Address <span class="text-red-500">*</span></label>
    <textarea name="address" id="address" rows="4"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Brief about the company address..." required>${data?.address ?? ""}</textarea>
  </div>

  <!-- Description -->
  <div>
    <label for="description" class="block font-medium text-sm ">Description <span class="text-red-500">*</span></label>
    <textarea name="description" id="description" rows="4"
      class="form-input w-full p-2 mt-1 rounded-md "
      placeholder="Brief about the company..." required>${data?.description}</textarea>
  </div>

  <!-- Submit Button -->
  <div class="text-right">
    <button type="submit"
      class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-semibold">
      Save Company Info
    </button>
  </div>
</form>
`,
"contact":`<form id="contactForm" onsubmit="onContactSave(event)" class="space-y-6 ">
  <input type="hidden" value="${data?.id}" name="id" id="contactId" />

  <div>
    <label class="block font-medium mb-1">Title <span class="text-red-500">*</span></label>
    <input type="text" value="${data?.title}" name="title" id="contactTitle" required class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. Visit Us" />
  </div>

  <div>
    <label class="block font-medium mb-1">Icon (Font Awesome Class)</label>
    <input type="text" name="icon" value="${data?.icon}" id="contactIcon" class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. fas fa-map-marker-alt" />
  </div>

  <div>
    <label class="block font-medium mb-1">Value <span class="text-red-500">*</span></label>
    <input type="text" name="value" value="${data?.value}" id="contactValue" required class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. 123 Tech Street, NY" />
  </div>

  <div>
    <label class="block font-medium mb-1">Description</label>
    <textarea name="description" id="contactDescription" rows="3" class="form-input w-full border px-4 py-2 rounded-md" placeholder="Optional details...">${data?.description}</textarea>
  </div>

  <div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-all">
      💾 Save Contact Info
    </button>
  </div>
</form>
`,
"social":`<form id="socialForm" onsubmit="onSocialSave(event)" class="space-y-4 ">

  <!-- Hidden ID for edit -->
  <input type="hidden" name="id" value="${data?.id}" id="socialId">

  <!-- Title -->
  <div>
    <label class="block font-semibold mb-1" for="title">Platform Name *</label>
    <input type="text" name="title" value="${data?.title}" id="title" class="form-input w-full border px-4 py-2 rounded-md" placeholder="e.g. Facebook" required>
  </div>

  <!-- Link -->
  <div>
    <label class="block font-semibold mb-1" for="link">Profile URL</label>
    <input type="url" name="link" id="link" value="${data?.link}" class="form-input w-full border px-4 py-2 rounded-md" placeholder="https://facebook.com/yourpage">
  </div>

  <!-- Icons -->
  <div>
    <label class="block font-semibold mb-1" for="icons">FontAwesome Icon Class *</label>
    <input type="text" name="icons" id="icons" value="${data?.icons}" class="form-input w-full border px-4 py-2 rounded-md" placeholder="fab fa-facebook" required>
  </div>

  <!-- Color Picker + Manual -->
  <div>
    <label class="block font-semibold mb-1">Icon Color</label>
    <div class="flex items-center gap-3">
      <input type="color" id="colorPicker" class="w-10 h-10 p-0 border-0 rounded cursor-pointer" onchange="document.getElementById('color').value = this.value">
      <input type="text" value="${data?.color}" name="color" id="color" class="flex-1 form-input w-full border px-4 py-2 rounded-md" placeholder="#4267B2"
             oninput="document.getElementById('colorPicker').value = this.value">
    </div>
  </div>

  <!-- Is Link -->
  <div>
    <label class="block font-semibold mb-1" for="isLink">Is Clickable Link</label>
    <select name="isLink" id="isLink" class="form-input w-full border px-4 py-2 rounded-md">
      <option class="bg-slate-200 text-gray-800" value="1" ${data?.isLink==1?'selected':''} >Yes</option>
      <option value="0" class="bg-slate-200 text-gray-800" ${data?.isLink==0?'selected':''}>No</option>
    </select>
  </div>

  <!-- Submit Button -->
  <div class="text-right">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow transition">
      💾 Save Social Link
    </button>
  </div>
</form>
`
    }
    return form[formType] || '';
}

const generateViewContent = (formType, data) => {
    const content = {
        "client": `<div class="space-y-4">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Details for ${formType.charAt(0).toUpperCase() + formType.slice(1)} #${data?.id ?? data}</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p><strong>Name:</strong>  ${data?.name ?? ""} </p>
                             <p><strong>Email:</strong>  ${data?.email ?? ""} </p>
                              <p><strong>Phone No:</strong>  ${data?.mobNo ?? ""} </p>
                            <p><strong>Request Service:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">${data?.service  ?? ""}</span></p>
                            <p><strong>Created:</strong> ${new Date().toLocaleDateString()}</p>
                            <p><strong>Last Modified:</strong> ${new Date().toLocaleDateString()}</p>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Message</h4>
                        <p class="text-gray-300 text-sm">${data?.message ?? `This is a sample description for ${formType} #${data?.id ?? data}. It contains detailed information about the item and its purpose.`}</p>
                    </div>
                </div>`,


    }
    return content[formType] || '';
}


async function onCompanySave(event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  const id = form.id?.value?.trim() ?? "";
  const name = form.name?.value?.trim();
  const description = form.description?.value?.trim();
  const subTitle = form.subTitle?.value?.trim();

  // Basic validation
  const errors = [];
  if (!name || name.length < 2) errors.push("Company name is required.");
  if (!description || description.length < 5) errors.push("Description is too short.");
  if (!subTitle) errors.push("Subtitle is required.");

  // Check media
  const logoInput = form.logo;
  const logoFile = logoInput?.files?.[0];

  // if (!id) errors.push("Id not Selected, Is required.");

  if (showValidationErrors(errors)) return;

  // If file uploaded
  if (logoFile) {
    formData.append("logo", logoFile);
  }

  try {
    form.querySelector("button[type='submit']").disabled = true;
    setLoading(true);

    const response = await fetch('../api/contact/company/save', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();

    if (!response.ok || !result.status) {
      showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
      showValidationErrors(["Error: " + (result.message || "Unknown error")]);
    } else {
      showSuccessToast(result.message || "Company info saved!", "success");
      setLoading(false);
      form.reset();
      location.reload();
    }

  } catch (err) {
    console.error("Submit error:", err);
    alert("Something went wrong during submission.");
  } finally {
    setLoading(false);
    form.querySelector("button[type='submit']").disabled = false;
  }
}

function onFileChange(event) {
    const logoInput = document.getElementById("logoInput");
    const logoPreview = document.getElementById("logoPreview");
    const logoPreviewContainer = document.getElementById("logoPreviewContainer");
    // const logoHiddenInput = document.getElementById("logo");



    const file = event.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            logoPreview.src = e.target.result;
            logoPreviewContainer.classList.remove("hidden");
            // logoHiddenInput.value = e.target.result; // Save base64 or blob URL
        };
        reader.readAsDataURL(file);
    }

}

function removeLogoPreview() {
    const logoInput = document.getElementById("logoInput");
    const logoPreview = document.getElementById("logoPreview");
    const logoPreviewContainer = document.getElementById("logoPreviewContainer");
    // const logoHiddenInput = document.getElementById("logo");
    logoPreview.src = "";
    logoPreviewContainer.classList.add("hidden");
    logoInput.value = "";
    // logoHiddenInput.value = "";
}

// contact functions

async function onContactSave(event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  const id = form.id?.value?.trim() ?? "";
  const title = form.title?.value?.trim();
  const icon = form.icon?.value?.trim();
  const value = form.value?.value?.trim();
  const description = form.description?.value?.trim();

  console.log(formData);
  
  // Basic validation
  const errors = [];
  if (!title || title.length < 2) errors.push("Title is required or at least write min 5 character.");
  if (!value || value.length < 2) errors.push("Value is required or or at least write min 5 character.");
  if (!description || description.length < 3) errors.push("Description must be at least 3 characters.");

  if (showValidationErrors(errors)) return;

  try {
    form.querySelector("button[type='submit']").disabled = true;
    setLoading(true);

    // Append all fields to FormData
    formData.append("id", id);
    formData.append("title", title);
    formData.append("icon", icon);
    formData.append("value", value);
    formData.append("description", description);

    const response = await fetch('../api/contact/save', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();

    if (!response.ok || !result.status) {
      showSuccessToast("Error: " + (result.message || "Unknown error"), "error");
      showValidationErrors(["Error: " + (result.message || "Unknown error")]);
    } else {
      showSuccessToast(result.message || "Contact saved!", "success");
      setLoading(false);
      form.reset();
      document.getElementById("contactId").value = ""; 
      window.location.reload();
    }

  } catch (err) {
    console.error("Submit error:", err);
    alert("Something went wrong during contact save.");
  } finally {
    setLoading(false);
    form.querySelector("button[type='submit']").disabled = false;
  }
}
async function onContactDelete(type,id) {
  if (!id || !deleteItem(type,id)) return;

  console.log(type,id);
  
  try {
    // setLoading(true);

    const response = await fetch(`../api/contact/clients/delete/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },

    });

    const result = await response.json();

    if (!response.ok || !result.status) {
      showSuccessToast("Error: " + (result.message || "Delete failed"), "error");
    } else {
      showSuccessToast(result.message || "Contact deleted successfully!", "success");
      window.location.reload();

    }

  } catch (error) {
    console.error("Delete error:", error);
    alert("Something went wrong while deleting the contact.");
  } finally {

  }
}

// social links functions

async function onSocialSave(event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  // Extract and trim input values
  const id = form.socialId?.value?.trim() || "";
  const title = form.title?.value?.trim();
  const link = form.link?.value?.trim();
  const icons = form.icons?.value?.trim();
  const color = form.color?.value?.trim();
  const isLink = form.isLink?.value?.trim();

  console.log(formData);
  
  // Basic validation
  const errors = [];
  if (!title || title.length < 2) errors.push("Platform title is required.");
  if (!icons || icons.length < 3) errors.push("Valid icon class is required.");
//   if (!color || !/^#([0-9A-Fa-f]{3}){1,2}$/.test(color)) errors.push("A valid hex color is required.");

  if (showValidationErrors(errors)) {
    
    return;
  }


  try {
    form.querySelector("button[type='submit']").disabled = true;
    setLoading(true);

    const response = await fetch("../api/contact/social/save", {
      method: "POST",
      body: formData
    });

    const result = await response.json();

    if (!response.ok || !result.status) {
      showSuccessToast("❌ " + (result.message || "Unknown error"), "error");
      showValidationErrors([result.message || "Failed to save data."]);
    } else {
      showSuccessToast(result.message || "✅ Social link saved!", "success");
      form.reset();
      location.reload(); // or update UI dynamically
    }
  } catch (err) {
    console.error("Submit error:", err);
    alert("Something went wrong.");
  } finally {
    setLoading(false);
    form.querySelector("button[type='submit']").disabled = false;
  }
}

async function deleteSocialItem(_,id) {
  if (!id) {
    alert("Invalid ID for deletion.");
    return;
  }

  const confirmDelete = confirm("Are you sure you want to delete this social item?");
  if (!confirmDelete) return;

  try {

    const response = await fetch(`../api/contact/social/delete/${id}`, {
      method: 'DELETE'
    });

    const result = await response.json();

    if (!response.ok || !result.status) {
      showSuccessToast("❌ " + (result.message || "Deletion failed."), "error");
    } else {
      showSuccessToast(result.message || "✅ Deleted successfully", "success");
      location.reload(); 
    }

  } catch (err) {
    console.error("Delete error:", err);
    alert("Something went wrong while deleting.");
  } finally {

  }
}
