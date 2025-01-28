document.addEventListener('DOMContentLoaded', function() {
    // Populate subscriptions table
    const subscriptionsTable = document.querySelector('#subscriptions-table tbody');
    const subscriptions = [
        { theme: 'Artificial Intelligence', date: '2025-01-15' },
        { theme: 'Cybersecurity', date: '2025-02-20' },
        { theme: 'Internet of Things', date: '2025-03-10' }
    ];
    subscriptions.forEach(sub => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${sub.theme}</td>
            <td>${sub.date}</td>
            <td>
                <button class="btn-danger" onclick="unsubscribe('${sub.theme}')">Unsubscribe</button>
            </td>
        `;
        subscriptionsTable.appendChild(tr);document.addEventListener("DOMContentLoaded", () => {
            loadSubscriptions()
            loadBrowsingHistory()
            loadProposedArticles()
            loadComments()
          
            // Handle article proposal form submission
            document.getElementById("article-proposal-form").addEventListener("submit", async function (e) {
              e.preventDefault()
          
              const formData = {
                title: document.getElementById("article-title").value,
                theme_id: document.getElementById("article-theme").value,
                content: document.getElementById("article-content").value,
                image: document.getElementById("article-image").value,
                description: document.getElementById("article-description").value,
              }
          
              try {
                const response = await fetch("/subscriber/propose-article", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  },
                  body: JSON.stringify(formData),
                })
          
                const data = await response.json()
                if (data.success) {
                  alert("Article proposal submitted successfully!")
                  this.reset()
                  loadProposedArticles()
                }
              } catch (error) {
                console.error("Error:", error)
                alert("Error submitting proposal")
              }
            })
          })
          
          async function loadSubscriptions() {
            try {
              const response = await fetch("/subscriber/subscriptions")
              const subscriptions = await response.json()
          
              const tbody = document.querySelector("#subscriptions-table tbody")
              tbody.innerHTML = ""
          
              subscriptions.forEach((sub) => {
                const tr = document.createElement("tr")
                tr.innerHTML = `
                          <td>${sub.theme}</td>
                          <td>${sub.date}</td>
                          <td>
                              <button class="btn-danger" onclick="unfollow(${sub.theme_id})">Unfolscribe</button>
                          </td>
                      `
                tbody.appendChild(tr)
              })
            } catch (error) {
              console.error("Error:", error)
            }
          }
          
          async function unfollow(themeId) {
            if (confirm("Are you sure you want to unfollow this theme?")) {
              try {
                const response = await fetch("/subscriber/unfollow", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  },
                  body: JSON.stringify({ theme_id: themeId }),
                })
          
                const data = await response.json()
                if (data.success) {
                  loadSubscriptions()
                }
              } catch (error) {
                console.error("Error:", error)
              }
            }
          }
          
          async function loadBrowsingHistory() {
            try {
              const response = await fetch("/subscriber/history")
              const history = await response.json()
          
              const tbody = document.querySelector("#history-table tbody")
              tbody.innerHTML = ""
          
              history.forEach((item) => {
                const tr = document.createElement("tr")
                tr.innerHTML = `
                          <td>${item.title}</td>
                          <td>${item.theme}</td>
                          <td>${item.date}</td>
                          <td>
                              <button class="btn-danger" onclick="deleteHistory(${item.article_id})">Delete</button>
                          </td>
                      `
                tbody.appendChild(tr)
              })
            } catch (error) {
              console.error("Error:", error)
            }
          }
          
          async function deleteHistory(articleId) {
            if (confirm("Are you sure you want to delete this history item?")) {
              try {
                const response = await fetch("/subscriber/history", {
                  method: "DELETE",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  },
                  body: JSON.stringify({ article_id: articleId }),
                })
          
                const data = await response.json()
                if (data.success) {
                  loadBrowsingHistory()
                }
              } catch (error) {
                console.error("Error:", error)
              }
            }
          }
          
          async function loadProposedArticles() {
            try {
              const response = await fetch("/subscriber/proposed-articles")
              const articles = await response.json()
          
              const tbody = document.querySelector("#proposed-articles-table tbody")
              tbody.innerHTML = ""
          
              articles.forEach((article) => {
                const tr = document.createElement("tr")
                tr.innerHTML = `
                          <td>${article.title}</td>
                          <td>${article.theme}</td>
                          <td>${article.date}</td>
                          <td>${article.status}</td>
                          <td>
                              <button class="btn-danger" onclick="cancelProposal(${article.id})">Cancel</button>
                          </td>
                      `
                tbody.appendChild(tr)
              })
            } catch (error) {
              console.error("Error:", error)
            }
          }
          
          async function cancelProposal(articleId) {
            if (confirm("Are you sure you want to cancel this proposal?")) {
              try {
                const response = await fetch("/subscriber/proposed-articles", {
                  method: "DELETE",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  },
                  body: JSON.stringify({ article_id: articleId }),
                })
          
                const data = await response.json()
                if (data.success) {
                  loadProposedArticles()
                }
              } catch (error) {
                console.error("Error:", error)
              }
            }
          }
          
          async function loadComments() {
            try {
              const response = await fetch("/subscriber/comments")
              const comments = await response.json()
          
              const container = document.getElementById("conversations-list")
              container.innerHTML = ""
          
              comments.forEach((comment) => {
                const div = document.createElement("div")
                div.className = "conversation-item"
                div.innerHTML = `
                          <h3>${comment.article_title}</h3>
                          <p>${comment.text}</p>
                          <p>Posted on: ${comment.date}</p>
                          <button class="btn-danger" onclick="deleteComment(${comment.id})">Delete</button>
                      `
                container.appendChild(div)
              })
            } catch (error) {
              console.error("Error:", error)
            }
          }
          
          async function deleteComment(commentId) {
            if (confirm("Are you sure you want to delete this comment?")) {
              try {
                const response = await fetch("/subscriber/comments", {
                  method: "DELETE",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  },
                  body: JSON.stringify({ comment_id: commentId }),
                })
          
                const data = await response.json()
                if (data.success) {
                  loadComments()
                }
              } catch (error) {
                console.error("Error:", error)
              }
            }
          }
          
          
    });

    // Populate browsing history table
    const historyTable = document.querySelector('#history-table tbody');
    const history = [
        { title: 'AI in Healthcare', theme: 'Artificial Intelligence', date: '2025-05-01' },
        { title: 'Cybersecurity Trends', theme: 'Cybersecurity', date: '2025-05-05' },
        { title: 'IoT Revolution', theme: 'Internet of Things', date: '2025-05-10' }
    ];
    history.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.title}</td>
            <td>${item.theme}</td>
            <td>${item.date}</td>
            <td>
                <button class="btn-primary" onclick="viewArticle('${item.title}')">View Article</button>
            </td>
        `;
        historyTable.appendChild(tr);
    });

    // Handle article proposal form submission
    document.getElementById('article-proposal-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('article-title').value;
        const theme = document.getElementById('article-theme').value;
        const content = document.getElementById('article-content').value;
        alert(`Article proposal submitted:\nTitle: ${title}\nTheme: ${theme}\nContent: ${content}`);
        this.reset();
    });

    // Populate proposed articles table
    const proposedArticlesTable = document.querySelector('#proposed-articles-table tbody');
    const proposedArticles = [
        { title: 'Future of AI', theme: 'Artificial Intelligence', date: '2025-04-15', status: 'Under Review' },
        { title: 'Blockchain Security', theme: 'Cybersecurity', date: '2025-04-20', status: 'Rejected' },
        { title: 'Smart Cities', theme: 'Internet of Things', date: '2025-04-25', status: 'Approved' }
    ];
    proposedArticles.forEach(article => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${article.title}</td>
            <td>${article.theme}</td>
            <td>${article.date}</td>
            <td>${article.status}</td>
        `;
        proposedArticlesTable.appendChild(tr);
    });

    // Populate conversations list
    const conversationsList = document.getElementById('conversations-list');
    const conversations = [
        { id: 1, title: 'Discussion on AI Ethics', date: '2025-05-15' },
        { id: 2, title: 'Cybersecurity Best Practices', date: '2025-05-20' },
        { id: 3, title: 'IoT in Smart Homes', date: '2025-05-25' }
    ];
    conversations.forEach(conv => {
        const div = document.createElement('div');
        div.className = 'conversation-item';
        div.innerHTML = `
            <h3>${conv.title}</h3>
            <p>Started on: ${conv.date}</p>
            <button class="btn-primary" onclick="viewConversation(${conv.id})">View</button>
            <button class="btn-danger" onclick="deleteConversation(${conv.id})">Delete</button>
        `;
        conversationsList.appendChild(div);
    });
});

// Function stubs for button actions
function unsubscribe(theme) {
    alert(`Unsubscribing from theme: ${theme}`);
}

function viewArticle(title) {
    alert(`Redirecting to article: ${title}`);
}

function viewConversation(id) {
    alert(`Viewing conversation with ID: ${id}`);
}

function deleteConversation(id) {
    if (confirm(`Are you sure you want to delete conversation with ID: ${id}?`)) {
        const conversationElement = document.querySelector(`.conversation-item:has(button[onclick="deleteConversation(${id})"])`);
        if (conversationElement) {
            conversationElement.remove();
            alert(`Conversation with ID: ${id} has been deleted.`);
        }
    }
}

