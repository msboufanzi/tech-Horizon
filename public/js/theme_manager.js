document.addEventListener("DOMContentLoaded", () => {
    const themeId = document.querySelector('meta[name="theme-id"]').content
  
    console.log("Theme ID from meta tag:", themeId)
  
    if (!themeId) {
      console.error("Theme ID not found. Make sure the meta tag is present in the HTML.")
      return
    }
  
    loadSubscriptions()
    loadArticles()
    loadProposals()
    loadComments()
    loadStatistics()
  
    async function loadSubscriptions() {
      try {
        const response = await fetch(`/theme-manager/subscriptions/${themeId}`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const subscriptions = await response.json()
        console.log("Subscriptions:", subscriptions)
  
        const tbody = document.querySelector("#subscriptions-table tbody")
        tbody.innerHTML = ""
  
        if (subscriptions.length === 0) {
          tbody.innerHTML = '<tr><td colspan="4">No subscriptions found.</td></tr>'
          return
        }
  
        subscriptions.forEach((sub) => {
          const tr = document.createElement("tr")
          tr.innerHTML = `
                      <td>${sub.user.name}</td>
                      <td>${sub.user.email}</td>
                      <td>${new Date(sub.created_at).toLocaleDateString()}</td>
                      <td>
                          <button class="btn-danger" onclick="kickSubscription(${sub.user_id})">
                              Kick Subscription
                          </button>
                      </td>
                  `
          tbody.appendChild(tr)
        })
      } catch (error) {
        console.error("Error loading subscriptions:", error)
        document.querySelector("#subscriptions-table tbody").innerHTML =
          `<tr><td colspan="4">Error loading subscriptions: ${error.message}</td></tr>`
      }
    }
  
    async function loadArticles() {
      try {
        const response = await fetch(`/theme-manager/articles/${themeId}`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const articles = await response.json()
        console.log("Articles:", articles)
  
        const tbody = document.querySelector("#articles-table tbody")
        tbody.innerHTML = ""
  
        if (articles.length === 0) {
          tbody.innerHTML = '<tr><td colspan="5">No articles found.</td></tr>'
          return
        }
  
        articles.forEach((article) => {
          const tr = document.createElement("tr")
          tr.innerHTML = `
                      <td>${article.title}</td>
                      <td>${article.author.name}</td>
                      <td>${new Date(article.created_at).toLocaleDateString()}</td>
                      <td>${article.ispublic ? "Published" : "Draft"}</td>
                      <td>
                          <button class="btn-primary" onclick="viewArticle(${article.id})">View</button>
                          <button class="btn-danger" onclick="deleteArticle(${article.id})">Delete</button>
                      </td>
                  `
          tbody.appendChild(tr)
        })
      } catch (error) {
        console.error("Error loading articles:", error)
        document.querySelector("#articles-table tbody").innerHTML =
          `<tr><td colspan="5">Error loading articles: ${error.message}</td></tr>`
      }
    }
  
    async function loadProposals() {
      try {
        const response = await fetch(`/theme-manager/proposals/${themeId}`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const proposals = await response.json()
        console.log("Proposals:", proposals)
  
        const tbody = document.querySelector("#proposals-table tbody")
        tbody.innerHTML = ""
  
        if (proposals.length === 0) {
          tbody.innerHTML = '<tr><td colspan="4">No proposals found.</td></tr>'
          return
        }
  
        proposals.forEach((proposal) => {
          const tr = document.createElement("tr")
          tr.innerHTML = `
                      <td>${proposal.title}</td>
                      <td>${proposal.author.name}</td>
                      <td>${new Date(proposal.created_at).toLocaleDateString()}</td>
                      <td>
                          <button class="btn-primary" onclick="reviewProposal(${proposal.id})">Review</button>
                          <button class="btn-danger" onclick="deleteProposal(${proposal.id})">Delete</button>
                          <button class="btn-primary" onclick="proposeToEditor(${proposal.id})">
                              Propose to Editor
                          </button>
                      </td>
                  `
          tbody.appendChild(tr)
        })
      } catch (error) {
        console.error("Error loading proposals:", error)
        document.querySelector("#proposals-table tbody").innerHTML =
          `<tr><td colspan="4">Error loading proposals: ${error.message}</td></tr>`
      }
    }
  
    async function loadComments() {
      try {
        const response = await fetch(`/theme-manager/comments/${themeId}`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const comments = await response.json()
        console.log("Comments:", comments)
  
        const tbody = document.querySelector("#comments-table tbody")
        tbody.innerHTML = ""
  
        if (comments.length === 0) {
          tbody.innerHTML = '<tr><td colspan="4">No comments found.</td></tr>'
          return
        }
  
        comments.forEach((comment) => {
          const tr = document.createElement("tr")
          tr.innerHTML = `
                      <td>${new Date(comment.created_at).toLocaleDateString()}</td>
                      <td>${comment.user.name}</td>
                      <td>${comment.text}</td>
                      <td>
                          <button class="btn-danger" onclick="deleteComment(${comment.id})">Delete</button>
                      </td>
                  `
          tbody.appendChild(tr)
        })
      } catch (error) {
        console.error("Error loading comments:", error)
        document.querySelector("#comments-table tbody").innerHTML =
          `<tr><td colspan="4">Error loading comments: ${error.message}</td></tr>`
      }
    }
  
    async function loadStatistics() {
      try {
        const response = await fetch(`/theme-manager/statistics/${themeId}`)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        const stats = await response.json()
        console.log("Statistics:", stats)
  
        const container = document.getElementById("stats-container")
        container.innerHTML = ""
  
        if (Object.keys(stats).length === 0) {
          container.innerHTML = "<p>No statistics found.</p>"
          return
        }
  
        Object.entries(stats).forEach(([key, value]) => {
          const div = document.createElement("div")
          div.className = "stat-box"
          div.innerHTML = `
                      <h3>${key.charAt(0).toUpperCase() + key.slice(1)}</h3>
                      <p>${value}</p>
                  `
          container.appendChild(div)
        })
      } catch (error) {
        console.error("Error loading statistics:", error)
        document.getElementById("stats-container").innerHTML = `<p>Error loading statistics: ${error.message}</p>`
      }
    }
  
    // Action functions
    window.kickSubscription = async (userId) => {
      if (confirm("Are you sure you want to remove this subscriber?")) {
        try {
          const response = await fetch("/theme-manager/subscriptions/remove", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ user_id: userId, theme_id: themeId }),
          })
  
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
  
          const result = await response.json()
          if (result.success) {
            loadSubscriptions()
          } else {
            throw new Error("Failed to remove subscriber")
          }
        } catch (error) {
          console.error("Error removing subscriber:", error)
          alert("Error removing subscriber: " + error.message)
        }
      }
    }
  
    window.deleteArticle = async (articleId) => {
      if (confirm("Are you sure you want to delete this article?")) {
        try {
          const response = await fetch(`/theme-manager/articles/${articleId}`, {
            method: "DELETE",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
          })
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
          loadArticles()
        } catch (error) {
          console.error("Error deleting article:", error)
          alert("Error deleting article: " + error.message)
        }
      }
    }
  
    window.reviewProposal = (proposalId) => {
      // Implement proposal review logic
      window.location.href = `/articles/${proposalId}`
    }
  
    window.proposeToEditor = async (proposalId) => {
      try {
        const response = await fetch("/theme-manager/proposals", {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          },
          body: JSON.stringify({
            proposal_id: proposalId,
            status: 2, // Status for "Proposed to Editor"
          }),
        })
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        loadProposals()
      } catch (error) {
        console.error("Error updating proposal:", error)
        alert("Error updating proposal: " + error.message)
      }
    }
  
    window.deleteComment = async (commentId) => {
      if (confirm("Are you sure you want to delete this comment?")) {
        try {
          const response = await fetch(`/theme-manager/comments/${commentId}`, {
            method: "DELETE",
            headers: {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
          })
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
          loadComments()
        } catch (error) {
          console.error("Error deleting comment:", error)
          alert("Error deleting comment: " + error.message)
        }
      }
    }
  })
  
  