document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
  
    // Modal elements
    const addUserModal = document.getElementById("add-user-modal")
    const editUserModal = document.getElementById("edit-user-modal")
    const manageRolesModal = document.getElementById("manage-roles-modal")
    const addUserBtn = document.getElementById("add-user-btn")
    const closeButtons = document.querySelectorAll(".close")
  
    // Forms
    const addUserForm = document.getElementById("add-user-form")
    const editUserForm = document.getElementById("edit-user-form")
    const manageRolesForm = document.getElementById("manage-roles-form")
  
    // Role selectors
    const roleSelect = document.getElementById("role")
    const newRoleSelect = document.getElementById("new-role")
    const themeSection = document.getElementById("theme-section")
    const roleThemeSection = document.getElementById("role-theme-section")
  
    // Article visibility toggle
    window.toggleArticleStatus = async (articleId, checkbox) => {
      try {
        const response = await fetch(`/articles/${articleId}/toggle-visibility`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
        })
        const data = await response.json()
        if (data.success) {
          const statusText = checkbox.closest("tr").querySelector("td:nth-child(4)")
          statusText.textContent = data.ispublic ? "Visible" : "Private"
        }
      } catch (error) {
        console.error("Error:", error)
        alert("Failed to update article visibility")
      }
    }
  
    // Modal functions
    function openModal(modal) {
      modal.style.display = "block"
    }
  
    function closeModal(modal) {
      modal.style.display = "none"
    }
  
    // Event Listeners
    addUserBtn.addEventListener("click", () => openModal(addUserModal))
  
    closeButtons.forEach((button) => {
      button.addEventListener("click", () => {
        closeModal(button.closest(".modal"))
      })
    })
  
    window.addEventListener("click", (event) => {
      if (event.target.classList.contains("modal")) {
        closeModal(event.target)
      }
    })
  
    // Role select handlers
    roleSelect.addEventListener("change", () => {
      themeSection.style.display = roleSelect.value === "theme_manager" ? "block" : "none"
    })
  
    newRoleSelect.addEventListener("change", () => {
      roleThemeSection.style.display = newRoleSelect.value === "theme_manager" ? "block" : "none"
    })
  
    // Form submissions
    addUserForm.addEventListener("submit", async (event) => {
      event.preventDefault()
      const formData = new FormData(addUserForm)
      const userData = {
        name: formData.get("name"),
        email: formData.get("email"),
        password: formData.get("password"),
        role: formData.get("role"),
      }
  
      if (userData.role === "theme_manager") {
        userData.theme_id = formData.get("theme_id")
      }
  
      try {
        const response = await fetch("/users", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify(userData),
        })
  
        const data = await response.json()
        if (data.success) {
          window.location.reload()
        } else {
          alert("Failed to add user: " + (data.message || "Unknown error"))
        }
      } catch (error) {
        console.error("Error:", error)
        alert("Failed to add user")
      }
    })
  
    // Edit user handlers
    document.querySelectorAll(".edit-user-btn").forEach((button) => {
      button.addEventListener("click", async () => {
        const row = button.closest("tr")
        const userId = row.dataset.userId
        const name = row.cells[0].textContent
        const email = row.cells[1].textContent
  
        document.getElementById("edit-user-id").value = userId
        document.getElementById("edit-name").value = name
        document.getElementById("edit-email").value = email
  
        openModal(editUserModal)
      })
    })
  
    editUserForm.addEventListener("submit", async (event) => {
      event.preventDefault()
      const userId = document.getElementById("edit-user-id").value
      const formData = new FormData(editUserForm)
  
      try {
        const response = await fetch(`/users/${userId}`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({
            name: formData.get("name"),
            email: formData.get("email"),
          }),
        })
  
        const data = await response.json()
        if (data.success) {
          window.location.reload()
        } else {
          alert("Failed to update user")
        }
      } catch (error) {
        console.error("Error:", error)
        alert("Failed to update user")
      }
    })
  
    // Manage roles handlers
    document.querySelectorAll(".manage-roles-btn").forEach((button) => {
      button.addEventListener("click", () => {
        const userId = button.closest("tr").dataset.userId
        document.getElementById("role-user-id").value = userId
        openModal(manageRolesModal)
      })
    })
  
    manageRolesForm.addEventListener("submit", async (event) => {
      event.preventDefault()
      const userId = document.getElementById("role-user-id").value
      const formData = new FormData(manageRolesForm)
      const newRole = formData.get("role")
      const themeId = formData.get("theme_id")
  
      try {
        const response = await fetch(`/users/${userId}/role`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({
            role: newRole,
            theme_id: themeId,
          }),
        })
  
        const data = await response.json()
        if (data.success) {
          window.location.reload()
        } else {
          alert("Failed to update role")
        }
      } catch (error) {
        console.error("Error:", error)
        alert("Failed to update role")
      }
    })
  
    // Block user handlers
    document.querySelectorAll(".block-user-btn").forEach((button) => {
      button.addEventListener("click", async () => {
        if (confirm("Are you sure you want to block this user?")) {
          const userId = button.closest("tr").dataset.userId
          try {
            const response = await fetch(`/users/${userId}`, {
              method: "DELETE",
              headers: {
                "X-CSRF-TOKEN": csrfToken,
              },
            })
  
            const data = await response.json()
            if (data.success) {
              window.location.reload()
            } else {
              alert("Failed to block user")
            }
          } catch (error) {
            console.error("Error:", error)
            alert("Failed to block user")
          }
        }
      })
    })
  
    // Magazine management
    window.addMagazine = async () => {
      const number = document.getElementById("magazine-number").value
      const title = document.getElementById("magazine-title").value
      const isPublic = document.getElementById("magazine-status").value === "1"
  
      try {
        const response = await fetch("/magazines", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
          },
          body: JSON.stringify({ number, title, is_public: isPublic }),
        })
  
        if (!response.ok) {
          const errorText = await response.text()
          throw new Error(`HTTP error! status: ${response.status}, body: ${errorText}`)
        }
  
        const data = await response.json()
  
        if (data.success) {
          alert("Magazine added successfully")
          window.location.reload()
        } else {
          throw new Error(data.message || "Failed to add magazine")
        }
      } catch (error) {
        console.error("Error:", error)
        alert(error.message)
      }
    }
  
    // Theme management
    document.getElementById("add-theme-form")?.addEventListener("submit", function (e) {
      e.preventDefault()
  
      const formData = new FormData(this)
  
      fetch("/add-theme", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          "theme-title": formData.get("theme-title"),
          "theme-image": formData.get("theme-image"),
          "theme-description": formData.get("theme-description"),
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Theme added successfully!")
            window.location.reload()
          } else {
            alert("Failed to add theme. Please try again.")
          }
        })
        .catch((error) => {
          console.error("Error:", error)
          alert("An error occurred. Please try again.")
        })
    })
  })
  
  