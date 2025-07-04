
const generateAddForm = (formType) => {


    if (!formType || typeof formType !== 'string') {
        console.error("Invalid form type provided:", formType);
        return '';
    }
    if (formType === "services") {
        async function setupBrandFormEvents() {
            // Toggle Emoji Picker
            document.getElementById("emojiPicker")?.classList.add("hidden");

            document.getElementById("iconInput")?.addEventListener("input", () => {
                document.querySelector(`[data-error="icon"]`)?.classList.add("hidden");
            });

            window.toggleEmojiPicker = () => {
                document.getElementById("emojiPicker").classList.toggle("hidden");
            };

            window.selectEmoji = (emoji) => {
                const input = document.getElementById("iconInput");
                input.value = emoji;
                document.getElementById("emojiPicker").classList.add("hidden");
            };

            window.handleMediaPreview = (input) => {
                const previewImg = document.getElementById("previewImage");
                const previewVid = document.getElementById("previewVideo");
                const wrapper = document.getElementById("mediaPreview");
                if (!input.files.length) return;
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    if (file.type.startsWith("image")) {
                        previewVid.classList.add("hidden");
                        previewImg.classList.remove("hidden");
                        previewImg.src = e.target.result;
                    } else if (file.type.startsWith("video")) {
                        previewImg.classList.add("hidden");
                        previewVid.classList.remove("hidden");
                        previewVid.src = e.target.result;
                    }
                    wrapper.classList.remove("hidden");
                    showSuccessToast('Media uploaded!')

                };
                reader.readAsDataURL(file);
            };

            window.removeMedia = () => {
                document.getElementById("mediaInput").value = "";
                document.getElementById("mediaPreview").classList.add("hidden");
                document.getElementById("previewImage").src = "";
                document.getElementById("previewVideo").src = "";
                showSuccessToast('Media Removed!', 'error')

            };

            window.handleFormSubmit = async (e) => {
                e.preventDefault();
                let valid = true;
                const fields = [, 'title', 'description', 'icon', 'features'];

                fields.forEach(name => {
                    const field = document.forms['brandForm'][name];
                    const errorEl = document.querySelector(`[data-error="${name}"]`);
                    if (!field?.value.trim()) {
                        errorEl?.classList.remove("hidden");
                        valid = false;
                    } else {
                        errorEl?.classList.add("hidden");
                    }
                });

                if (valid) {

                    const formData = new FormData(document.getElementById("brandForm"));
                    // console.log(formData.getAll());
                    setLoading(true);
                    await fetch("../api/services/create", {
                        method: "POST",
                        body: formData,
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error("Failed to submit form");
                        }
                        return response.json();
                    }).then(data => {
                        console.log("Form submitted successfully:", data);
                        setLoading(false);
                        showSuccessToast('Form submitted successfully!')
                        // Optionally, you can reset the form or close the modal
                        // document.getElementById("brandForm").reset();
                    }).catch(error => {
                        console.error("Error submitting form:", error);
                        setLoading(false);
                        showSuccessToast('Failed to upload media!', 'error');
                    })

                    setLoading(false)

                    alert("Form submitted successfully!");
                    // Do AJAX or other logic here
                }
            };
        }
        setupBrandFormEvents();
    }
    const form = {


        services: ` <form onsubmit="handleFormSubmit(event)" class="p-8 rounded-2xl w-full max-w-2xl  text-white space-y-6 animate-fade-in" id="brandForm" novalidate>

        <h2 class="text-2xl font-bold flex items-center gap-2 text-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3v2.25m4.5-2.25V5.25M3 12h18M12 21v-6.75" />
          </svg>
          Add New Brand Section
        </h2>


        <!-- Title -->
        <div>
          <label class="block mb-2 text-sm font-medium">Title</label>
          <input name="title" type="text" class="form-input w-full p-3 rounded-lg text-white" placeholder="Enter title" required>
          <p class="text-sm text-red-400 mt-1 hidden" data-error="title">Title is required.</p>
        </div>

        <!-- Description -->
        <div>
          <label class="block mb-2 text-sm font-medium">Description</label>
          <textarea name="description" class="form-input w-full p-3 rounded-lg text-white h-24" placeholder="Enter description" required></textarea>
          <p class="text-sm text-red-400 mt-1 hidden" data-error="description">Description is required.</p>
        </div>

        <!-- Icon (with emoji picker) -->
        <div>
          <label class="block mb-2 text-sm font-medium">Choose an Emoji</label>
          <div class="flex gap-3 items-center">
            <input name="icon" type="text" id="iconInput" class="form-input w-full p-3 rounded-lg text-white" placeholder="🎯" required>
            <button type="button" onclick="toggleEmojiPicker()" class="px-3 py-2 rounded bg-gray-600 hover:bg-gray-700">😊</button>
          </div>
          <div id="emojiPicker" class="flex flex-wrap mt-2 gap-2 hidden">
            <span class="cursor-pointer text-2xl" onclick="selectEmoji('🔥')">🔥</span>
            <span class="cursor-pointer text-2xl" onclick="selectEmoji('💡')">💡</span>
            <span class="cursor-pointer text-2xl" onclick="selectEmoji('📈')">📈</span>
            <span class="cursor-pointer text-2xl" onclick="selectEmoji('🎯')">🎯</span>
            <span class="cursor-pointer text-2xl" onclick="selectEmoji('🚀')">🚀</span>
          </div>
          <p class="text-sm text-red-400 mt-1 hidden" data-error="icon">Please select or enter an emoji.</p>
        </div>

        <!-- Image/Video Upload -->
        <div>
          <label class="block mb-2 text-sm font-medium">Upload Image or Video</label>
          <input name="media" multiple id="mediaInput" type="file" accept="image/*,video/*" class="form-input w-full p-2 rounded-lg text-gray-300 text-sm" onchange="handleMediaPreview(this)">
          <div id="mediaPreview" class="mt-3 relative hidden">
            <button type="button" onclick="removeMedia()" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">✖</button>
            <img id="previewImage" class="rounded-lg max-h-60 object-contain hidden" />
            <video id="previewVideo" class="rounded-lg max-h-60 hidden" controls></video>
          </div>
        </div>

        <!-- Features -->
        <div>
          <label class="block mb-2 text-sm font-medium">Features (comma separated)</label>
          <input name="features" type="text" class="form-input w-full p-3 rounded-lg text-white" placeholder="Brand Positioning, Messaging..." required>
          <p class="text-sm text-red-400 mt-1 hidden" data-error="features">At least one feature is required.</p>
        </div>

        <!-- Reverse Layout -->
        <div class="flex items-center space-x-3">
          <input type="checkbox" name="isReversed" id="reverseToggle" class="form-input w-4 h-4 rounded">
          <label for="reverseToggle" class="text-sm">Reverse Layout</label>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 pt-4">
          <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg">Add Section</button>
        </div>
      </form>
`,
    }
    return form[formType] || '';
}
const generateEditForm = (formType, itemId) => {
    console.log(`Generating edit form for ${formType} with ID ${itemId}`);
    const form = {
        "services": ` <form 
    method="POST" 
    action="/add-service" 
    class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-lg transition-all duration-500 hover:shadow-2xl animate-fade-in"
  >
    <h2 class="text-2xl font-bold mb-6 text-center">Add New Service</h2>

    <div class="mb-4">
      <label for="categoryId" class="block mb-2 font-medium">Category ID</label>
      <input type="text" name="categoryId" id="categoryId" placeholder="e.g., branding_3424455655"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
    </div>

    <div class="mb-4">
      <label for="title" class="block mb-2 font-medium">Title</label>
      <input type="text" name="title" id="title" placeholder="e.g., Brand Strategy"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
    </div>

    <div class="mb-4">
      <label for="description" class="block mb-2 font-medium">Description</label>
      <textarea name="description" id="description" rows="4"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required></textarea>
    </div>

    <div class="mb-4">
      <label for="icon" class="block mb-2 font-medium">Icon (emoji)</label>
      <input type="text" name="icon" id="icon" placeholder="e.g., 🎯"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    </div>

    <div class="mb-4">
      <label for="image" class="block mb-2 font-medium">Image URL</label>
      <input type="url" name="image" id="image" placeholder="https://example.com/image.jpg"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    </div>

    <div class="mb-4">
      <label for="features" class="block mb-2 font-medium">Features (comma-separated)</label>
      <input type="text" name="features" id="features"
        placeholder="e.g., Brand Positioning, Messaging Framework"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    </div>

    <div class="mb-6">
      <label for="isReversed" class="block mb-2 font-medium">Is Reversed?</label>
      <select name="isReversed" id="isReversed"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        <option value="false">No</option>
        <option value="true">Yes</option>
      </select>
    </div>

    <button type="submit"
      class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
      ➕ Add Service
    </button>
  </form>`,
    }
    return form[formType] || '';
}

const generateViewContent = async (formType, itemId) => {
    console.log(`Generating view content for ${formType} with ID ${itemId}`);

    try {
        let data = {};

        if (formType == 'service') {
            const response = await fetch(`../api/services/${itemId}`);
            if (!response.ok) throw new Error("Not found");
            data = await response.json();
        }

        console.log("Fetched service:", data);



        const content = {
            "service": `
        <div class="space-y-4">
          <div class="bg-gray-800/50 rounded-lg p-4">
            <h4 class="font-medium mb-2">Details for ${formType.charAt(0).toUpperCase() + formType.slice(1)} #${itemId}</h4>
            <div class="space-y-2 text-sm text-gray-300">
              <p><strong>Title:</strong> ${data.title ?? 'No title'}</p>
               <p><strong>Features:</strong> ${(Array?.isArray(data?.features) && data?.features?.join(",")) ?? 'No title'}</p>
              <p><strong>Status:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Active</span></p>
              <p><strong>Created:</strong> ${new Date().toLocaleDateString()}</p>
              <p><strong>Last Modified:</strong> ${new Date().toLocaleDateString()}</p>
            </div>
          </div>
          <div class="bg-gray-800/50 rounded-lg p-4">
            <h4 class="font-medium mb-2">Description</h4>
            <p class="text-gray-300 text-sm">${data.description ?? "No description provided."}</p>
          </div>
        </div>
      `
        };

        return content[formType] || '';

    } catch (err) {
        console.error("Error fetching service:", err);
        return `<div class="text-red-500">Failed to load content: ${err.message}</div>`;
    }
};



const deleteServices = async (_, id) => {






    if (deleteItem()) {
        fetch(`../api/services/delete/${id}`, {
            method: "DELETE",
            headers: {
                'Content-Type': 'application/json'
            },
        }
        ).then(response => {
            if (!response?.ok) {

            }
            return response.json();
        }).then(data => {

            console.log("Service deleted successfully:", data);
            showSuccessToast('Service deleted successfully!');
        }).catch(error => {
            console.error("Error deleting service:", error);
        })
        console.log("hello from deleteItem");

    }



}