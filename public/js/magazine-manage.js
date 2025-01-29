document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
    const magazineId = window.location.pathname.split("/").pop()
  
    window.addArticleToMagazine = async () => {
      const articleSelect = document.getElementById("article-select")
      const articleId = articleSelect.value
  
      if (!articleId) {
        alert("Please select an article")
        return
      }
  
      try {
        const response = await fetch(`/magazine/${magazineId}/articles`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({ article_id: articleId }),
        })
  
        if (!response.ok) {
          throw new Error("Failed to add article")
        }
  
        const data = await response.json()
  
        if (data.success) {
          window.location.reload()
        } else {
          throw new Error(data.message || "Failed to add article")
        }
      } catch (error) {
        console.error("Error:", error)
        alert(error.message)
      }
    }
  
    window.removeArticle = async (articleId) => {
      if (!confirm("Are you sure you want to remove this article from the magazine?")) {
        return
      }
  
      try {
        const response = await fetch(`/magazine/${magazineId}/articles/${articleId}`, {
          method: "DELETE",
          headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
        })
  
        if (!response.ok) {
          throw new Error("Failed to remove article")
        }
  
        const data = await response.json()
  
        if (data.success) {
          const row = document.querySelector(`tr[data-article-id="${articleId}"]`)
          if (row) {
            row.remove()
          }
        } else {
          throw new Error(data.message || "Failed to remove article")
        }
      } catch (error) {
        console.error("Error:", error)
        alert(error.message)
      }
    }
  })
  
  