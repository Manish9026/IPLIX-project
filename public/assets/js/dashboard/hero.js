


const buttonClassMap = {
    primary: "bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-all duration-200",
    secondary: "bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-all duration-200",
    outline: "border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200",
    link: "text-blue-400 hover:text-blue-600 underline font-medium transition-colors duration-200"
};
let btnIndex = 0;

const generateAddForm = (formType, ...args) => {
    const section = args[0] ?? ""
    console.log(args, section);

    const form = {
        "hero": `<form id="heroContentForm" class="space-y-6 max-w-4xl mx-auto" onsubmit="handleHeroSubmit(event)">
  <!-- Section + ID -->
  <input type="hidden" name="section" value="${section ?? "home"}">
  <input type="hidden" name="id" id="hero-id">

  <!-- Main Fields -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1 text-white">Title</label>
      <input name="title" required class="w-full p-2 rounded form-input text-white" placeholder="Enter title" />
    </div>

    <div>
      <label class="block text-sm font-medium mb-1 text-white">Gradient Title</label>
      <input name="gradientTitle" required class="w-full p-2 rounded form-input text-white" placeholder="Gradient title" />
    </div>

    <div>
      <label class="block text-sm font-medium mb-1 text-white">Subtitle</label>
      <input name="subTitle" required class="w-full p-2 rounded form-input text-white" placeholder="Subtitle" />
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1 text-white">Description</label>
    <textarea name="description" required class="w-full p-2 rounded form-input text-white" rows="4" placeholder="Description"></textarea>
  </div>

  <!-- Buttons Section -->
<div>
  <h4 class="text-white font-semibold text-lg mb-3">Buttons</h4>
  <div id="btnArea" class="space-y-4"></div>

  <button type="button" onclick="addButtonBlock()" class="bg-blue-600 text-white px-4 py-2 mt-3 rounded shadow hover:bg-blue-700 transition">
    ➕ Add Another Button
  </button>
</div>

  <!-- Submit -->
  <div class="pt-6">
    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
    <button type="submit" class="bg-purple-600 px-6 py-2 text-white rounded shadow hover:bg-purple-700 transition">
      💾 Save Hero Content
    </button>
  </div>
</form>

`,
    }
    return form[formType] || '';
}
const generateEditForm = (formType, item, ...args) => {

    const section = args[0] ?? "home";
    console.log(args, section, item);

    const form = {
        "hero": `<form id="heroContentForm" class="space-y-6 max-w-4xl mx-auto" onsubmit="handleHeroSubmit(event)">
  <!-- Section + ID -->
  <input type="hidden" name="section" value="${section ?? "home"}">
  <input type="hidden" value=${item?.id} name="id" id="hero-id">

  <!-- Main Fields -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1 text-white">Title</label>
      <input name="title" value="${item?.title}" required class="w-full p-2 rounded form-input text-white" placeholder="Enter title" />
    </div>

    <div>
      <label class="block text-sm font-medium mb-1 text-white">Gradient Title</label>
      <input name="gradientTitle" value="${item?.gradientTitle}" required class="w-full p-2 rounded form-input text-white" placeholder="Gradient title" />
    </div>

    <div>
      <label class="block text-sm font-medium mb-1 text-white">Subtitle</label>
      <input name="subTitle" value="${item?.subTitle}" required class="w-full p-2 rounded form-input text-white" placeholder="Subtitle" />
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1 text-white">Description</label>
    <textarea name="description" required class="w-full p-2 rounded form-input text-white" rows="4" placeholder="Description">${item?.description}</textarea>
  </div>

  <!-- Buttons Section -->
<div>
  <h4 class="text-white font-semibold text-lg mb-3">Buttons</h4>

  <div id="btnArea" class="space-y-4">
    
     ${item?.btn?.length > 0 && Array?.isArray(item?.btn) ? item?.btn.map((btn, i) => {
            btnIndex=i+1;
            return (
                `  <div class="rounded-lg form-input p-4 space-y-2 shadow relative border border-gray-700" data-index=${i}> 
    <button type="button" onclick="removeButtonBlock(this)"
              class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm font-bold"
              title="Remove">
        ✖
      </button>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4" data-btn>
        <div>
          <label class="block text-sm text-white mb-1">Label</label>
          <input name="btn[${i}][label]" value="${btn?.label}" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Button Label" />
        </div>
        <div>
          <label class="block text-sm text-white mb-1">Link</label>
          <input name="btn[${i}][link]" value="${btn?.link}" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="https://example.com" />
        </div>
        <div>
          <label class="block text-sm text-white mb-1">Design</label>
          <select name="btn[${i}][design]" class="w-full p-2 rounded bg-gray-700 text-white">
            <option value="${buttonClassMap['primary']}" ${btn?.design === buttonClassMap['primary'] ? "selected" : ""}>Primary</option>
            <option value="${buttonClassMap['secondary']}" ${btn?.design === buttonClassMap['secondary'] ? "selected" : ""}>Secondary</option>
            <option value="${buttonClassMap['outline']}" ${btn?.design ===buttonClassMap['outline']  ? "selected" : ""}>Outline</option>
            <option value="${buttonClassMap['link']}" ${btn?.design === buttonClassMap['link']  ? "selected" : ""}>Link</option>
          </select>
        </div>
      </div> 
      
      </div>`
            )
        }).join(""):""

            }
    
  </div>

  <button type="button" onclick="addButtonBlock()" class="bg-blue-600 text-white px-4 py-2 mt-3 rounded shadow hover:bg-blue-700 transition">
    ➕ Add Another Button
  </button>
</div>

  <!-- Submit -->
  <div class="pt-6">
    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>

    <button type="submit" class="bg-purple-600 px-6 py-2 text-white rounded shadow hover:bg-purple-700 transition">
      💾 Save Hero Content
    </button>
  </div>
</form>

`
    }
    return form[formType] || '';
}

const generateViewContent = (formType, itemId) => {
    const content = {
        "hero": `<div class="space-y-4">
                    <div class="form-input/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Details for ${formType.charAt(0).toUpperCase() + formType.slice(1)} #${itemId}</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p><strong>Title:</strong> Sample ${formType} title</p>
                            <p><strong>Status:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Active</span></p>
                            <p><strong>Created:</strong> ${new Date().toLocaleDateString()}</p>
                            <p><strong>Last Modified:</strong> ${new Date().toLocaleDateString()}</p>
                        </div>
                    </div>
                    <div class="form-input/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Description</h4>
                        <p class="text-gray-300 text-sm">This is a sample description for ${formType} #${itemId}. It contains detailed information about the item and its purpose.</p>
                    </div>
                </div>`,
    }
    return content[formType] || '';
}


function handleEditHero(encodedHero, section) {
    btnIndex=0
  try {
    const hero = JSON.parse(decodeURIComponent(escape(atob(encodedHero))));
    editItem("hero", hero, section);
  } catch (err) {
    console.error("Failed to decode hero data:", err);
  }
}



async function fetchHeroData(initialSection = "home") {
  const selectEl = document.getElementById("sectionSelect");
  const container = document.getElementById("heroDataContainer");

  let section = selectEl?.value || initialSection;

  if (!section) {
    container.innerHTML = "<div class='text-red-500'>Please select a section.</div>";
    return;
  }

  container.innerHTML = `
    <div class="bg-gray-900 text-white flex items-center justify-center h-screen overflow-hidden relative">
      <div class="absolute top-10 left-10 text-6xl opacity-10 floating-icon">✨</div>
      <div class="absolute top-1/4 right-20 text-5xl opacity-10 floating-icon">🚀</div>
      <div class="absolute bottom-20 left-1/3 text-7xl opacity-10 floating-icon">💡</div>
      <div class="absolute bottom-10 right-10 text-6xl opacity-10 floating-icon">⚙️</div>
      <div class="text-center">
        <div class="flex justify-center items-center mb-6">
          <div class="w-12 h-12 border-4 border-blue-500 border-dashed rounded-full animate-spin"></div>
        </div>
        <h1 class="text-2xl font-semibold mb-2">Loading, please wait...</h1>
        <p class="text-gray-400">We’re preparing something amazing for you ✨</p>
      </div>
    </div>`;

  try {
    const res = await fetch(`../api/hero/${section}`);
    const result = await res.json();

    if (!res.ok || !result?.status) {
      container.innerHTML = `<div class="text-red-500">Error: ${result?.message ?? "Failed to fetch data."}</div>`;
      return;
    }

    const hero = result.data;

    // Safely encode hero data in base64 to avoid broken HTML
    const heroEncoded = btoa(unescape(encodeURIComponent(JSON.stringify(hero))));

    container.innerHTML = `
      <div class="glass-card p-6 rounded-xl mb-6 border border-gray-700">
        <h4 class="text-lg font-semibold mb-4 text-blue-400 capitalize">${section} Hero Section</h4>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium mb-2">Main Title</label>
            <input type="text" class="w-full p-3 form-input rounded-lg bg-gray-800 text-white" value="${hero?.title || ""}" readonly>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Subtitle</label>
            <input type="text" class="w-full p-3 form-input rounded-lg bg-gray-800 text-white" value="${hero?.gradientTitle || ""}" readonly>
          </div>
          <div class="lg:col-span-2">
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea class="w-full p-3 form-input rounded-lg h-24 bg-gray-800 text-white" readonly>${hero?.description || ""}</textarea>
          </div>
        </div>

        ${Array.isArray(hero?.btn) && hero?.btn.length > 0
          ? `
            <div class="mt-6 space-y-3">
              <div class="font-semibold text-white">Hero Buttons:</div>
              ${hero.btn.map((btn) => `
                <span class="inline-flex flex-col p-4 w-full max-w-xs bg-gray-800 rounded-lg border border-gray-700 ">
                  <h2 class="text-sm text-blue-300"><strong>🔗</strong> ${btn?.link}</h2>
                  <button class="${btn?.design || "bg-blue-600 text-white px-3 py-1 mt-6 rounded"}">
                    ${btn?.label || "Button"}
                  </button>
                </span>
              `).join("")}
            </div>
          `
          : `<div class="mt-4 text-gray-400 italic">No buttons available.</div>`}

        <div class="flex space-x-2 mt-6">
          <button onclick='handleEditHero("${heroEncoded}", "${section}")' class="action-btn bg-yellow-600 hover:bg-yellow-700 px-3 py-1 rounded text-sm text-white">
            ✏️ Edit
          </button>
        </div>
      </div>`;
  } catch (err) {
    console.error("Error:", err);
    container.innerHTML = `<div class="text-red-500">Unexpected error occurred.</div>`;
  }
}






function addButtonBlock(btn = {}) {
    const { label = "", link = "", design = "primary" } = btn;

    console.log(btnIndex);
    
    const container = document.createElement("div");
    container.className = "rounded-lg form-input p-4 space-y-2 shadow relative border border-gray-700";
    container.dataset.index = btnIndex;

    container.innerHTML = `
      <button type="button" onclick="removeButtonBlock(this)"
              class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm font-bold"
              title="Remove">
        ✖
      </button>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4" data-btn>
        <div>
          <label class="block text-sm text-white mb-1">Label</label>
          <input name="btn[${btnIndex}][label]" value="${label}" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Button Label" />
        </div>
        <div>
          <label class="block text-sm text-white mb-1">Link</label>
          <input name="btn[${btnIndex}][link]" value="${link}" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="https://example.com" />
        </div>
        <div>
          <label class="block text-sm text-white mb-1">Design</label>
          <select name="btn[${btnIndex}][design]" class="w-full p-2 rounded bg-gray-700 text-white">
            <option value="${buttonClassMap['primary']}" ${design === "primary" ? "selected" : ""}>Primary</option>
            <option value="${buttonClassMap['secondary']}" ${design === "secondary" ? "selected" : ""}>Secondary</option>
            <option value="${buttonClassMap['outline']}" ${design === "outline" ? "selected" : ""}>Outline</option>
            <option value="${buttonClassMap['link']}" ${design === "link" ? "selected" : ""}>Link</option>
          </select>
        </div>
      </div>
    `;

    document.getElementById("btnArea")?.appendChild(container);
    btnIndex++;
}

function removeButtonBlock(button) {
    const block = button.closest("div[data-index]");
    if (block) block.remove();
}

async function handleHeroSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    console.log(formData);
        setLoading(false)
    try {
        const res = await fetch("../api/hero/save", {
            method: "POST",
            body: formData,
        });

        const result = await res.json();
        if (res.ok && result.status) {
            alert(result.message || "Saved successfully!");
            form.reset();
            document.getElementById("btnArea").innerHTML = "";
            btnIndex = 0;
            addButtonBlock();
        } else {
            alert(result.message || "Failed to save hero content.");
        }
    } catch (error) {
        alert("Error submitting form: " + error.message);
    }
    finally{
        setLoading(false)
    }
}
async function handleHeroSubmit(event) {
  event.preventDefault();

  const form = event.target;
  const submitBtn = form.querySelector("button[type='submit']");

  const title = form.title?.value.trim();
  const gradientTitle = form.gradientTitle?.value.trim();
  const subTitle = form.subTitle?.value.trim();
  const description = form.description?.value.trim();

  // 🔍 Validation
  const errors = [];
  if (!title || title.length < 3) errors.push("Title must be at least 3 characters.");
//   if (!gradientTitle || gradientTitle.length < 3) errors.push("Gradient Title is required.");
//   if (!subTitle || subTitle.length < 3) errors.push("Sub Title is required.");
  if (!description || description.length < 10) errors.push("Description must be at least 10 characters.");

const btnContainers = form.querySelectorAll("[data-btn]");
if (btnContainers.length > 0) {
  btnContainers.forEach((btnDiv, i) => {
    const link = btnDiv.querySelector(`input[name="btn[${i}][link]"]`)?.value.trim();
    const label = btnDiv.querySelector(`input[name="btn[${i}][label]"]`)?.value.trim();
    const design = btnDiv.querySelector(`select[name="btn[${i}][design]"]`)?.value.trim();

    if (!link) errors.push(`Button ${i + 1}: Link is required.`);
    if (!label) errors.push(`Button ${i + 1}: Label is required.`);
    if (!design) errors.push(`Button ${i + 1}: Design is required.`);
  });
}
  if ( showValidationErrors(errors)) return;


  const formData = new FormData(form);
//   formData.append("section", section); // e.g., home, contact
//   formData.append("id", id);

  // Disable submit button
  submitBtn.disabled = true;
  setLoading(true);

  try {

    const res = await fetch("../api/hero/save", {
      method: "POST",
      body: formData,
    });

    const result = await res.json();

    if (res.ok && result.status) {
      showSuccessToast(result.message || "Hero section saved!", "success");


      form.reset();
      document.getElementById("btnArea").innerHTML = "";
      btnIndex = 0;
      addButtonBlock(); // Add initial button after reset
    } else {
      const msg = result?.errors
        ? Object.values(result.errors).join("\n")
        : result.message || "Something went wrong!";
      showSuccessToast(msg, "error");
    }
  } catch (error) {
    showSuccessToast("Unexpected error: " + error.message, "error");
    console.error("Hero submit error:", error);
  } finally {
    submitBtn.disabled = false;
    setLoading(false);
  }
}

window.onload = () => {
    // addButtonBlock(); // Initial block
};


document.addEventListener('DOMContentLoaded', function() {
     document.getElementById("sectionSelect").value="home";
fetchHeroData("home")
});