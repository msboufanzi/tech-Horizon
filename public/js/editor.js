document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
  
    function toggleArticleStatus(articleId, checkbox) {
      fetch(`/articles/${articleId}/toggle-visibility`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            const statusText = checkbox.closest("tr").querySelector("td:nth-child(4)")
            statusText.textContent = data.ispublic ? "Visible" : "Private"
          }
        })
        .catch((error) => {
          console.error("Error:", error)
          alert("Failed to update article visibility")
        })
    }
  
    const addUserModal = document.getElementById("add-user-modal")
    const editUserModal = document.getElementById("edit-user-modal")
    const manageRolesModal = document.getElementById("manage-roles-modal")
    const addUserBtn = document.getElementById("add-user-btn")
    const closeButtons = document.querySelectorAll(".close")
  
    const addUserForm = document.getElementById("add-user-form")
    const editUserForm = document.getElementById("edit-user-form")
    const manageRolesForm = document.getElementById("manage-roles-form")
  
    const roleSelect = document.getElementById("role")
    const newRoleSelect = document.getElementById("new-role")
    const themeSection = document.getElementById("theme-section")
    const roleThemeSection = document.getElementById("role-theme-section")
  
    function openModal(modal) {
      modal.style.display = "block"
    }
  
    function closeModal(modal) {
      modal.style.display = "none"
    }
  
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
  
    roleSelect.addEventListener("change", () => {
      themeSection.style.display = roleSelect.value === "manager" ? "block" : "none"
    })
  
    newRoleSelect.addEventListener("change", () => {
      roleThemeSection.style.display = newRoleSelect.value === "manager" ? "block" : "none"
    })
  
    addUserForm.addEventListener("submit", async (event) => {
      event.preventDefault()
      const formData = new FormData(addUserForm)
      const userData = {
        name: formData.get("name"),
        email: formData.get("email"),
        password: formData.get("password"),
        role: formData.get("role"),
      }
  
      if (userData.role === "manager") {
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
  
    document.querySelectorAll(".delete-theme-btn").forEach((button) => {
      button.addEventListener("click", async () => {
        if (confirm("Are you sure you want to delete this theme?")) {
          const themeId = button.dataset.themeId
          try {
            const response = await fetch(`/theme-manager/delete-theme/${themeId}`, {
              method: "DELETE",
              headers: {
                "X-CSRF-TOKEN": csrfToken,
              },
            })
  
            if (response.ok) {
              const data = await response.json()
              if (data.success) {
                button.closest("tr").remove()
                alert("Theme deleted successfully")
              } else {
                alert(data.message || "Failed to delete theme")
              }
            } else {
              alert("Failed to delete theme")
            }
          } catch (error) {
            console.error("Error:", error)
            alert("Failed to delete theme")
          }
        }
      })
    })
  
    const addArticleForm = document.getElementById("add-article-form")
    if (addArticleForm) {
      addArticleForm.addEventListener("submit", async (e) => {
        e.preventDefault()
  
        const formData = new FormData(addArticleForm)
        try {
          const response = await fetch("/editor/add-article", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": csrfToken,
              Accept: "application/json",
            },
            body: formData,
          })
  
          const result = await response.json()
  
          if (result.success) {
            alert(result.message)
            addArticleForm.reset()
  
            const articlesTable = document.getElementById("existing-articles-table")
            if (articlesTable) {
              const newRow = articlesTable.insertRow(1)
              newRow.innerHTML = `
                              <td>${result.article.title}</td>
                              <td>${result.article.author.name}</td>
                              <td>${result.article.theme.title}</td>
                              <td>Visible</td>
                              <td>
                                  <a href="/article/${result.article.id}" class="btn-primary">View</a>
                                  <label class="switch">
                                      <input type="checkbox" checked onchange="toggleArticleStatus(${result.article.id}, this)">
                                      <span class="slider round"></span>
                                  </label>
                              </td>
                          `
            }
          } else {
            alert("Failed to add article: " + result.message)
          }
        } catch (error) {
          console.error("Error:", error)
          alert("Failed to add article")
        }
      })
    }
  
    window.toggleArticleStatus = toggleArticleStatus
  })
  
  