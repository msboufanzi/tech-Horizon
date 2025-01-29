document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    window.toggleArticleStatus = async (articleId, checkbox) => {
        try {
            const response = await fetch(
                `/articles/${articleId}/toggle-visibility`,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );
            const data = await response.json();
            if (data.success) {
                const statusText = checkbox
                    .closest("tr")
                    .querySelector("td:nth-child(4)");
                statusText.textContent = data.ispublic ? "Visible" : "Private";
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Failed to update article visibility");
        }
    };

    window.editUser = async (userId) => {
        const name = prompt("Enter new name:");
        const email = prompt("Enter new email:");
        if (name && email) {
            try {
                const response = await fetch(`/users/${userId}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ name, email }),
                });
                const data = await response.json();
                if (data.success) {
                    const row = document.querySelector(
                        `tr[data-user-id="${userId}"]`
                    );
                    row.cells[0].textContent = data.user.name;
                    row.cells[1].textContent = data.user.email;
                    alert("User updated successfully");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to update user");
            }
        }
    };

    window.manageRoles = async (userId) => {
        const role = prompt(
            "Enter new role (subscriber/editor/theme_manager):"
        );
        if (role) {
            try {
                const response = await fetch(`/users/${userId}/role`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ role }),
                });
                const data = await response.json();
                if (data.success) {
                    const row = document.querySelector(
                        `tr[data-user-id="${userId}"]`
                    );
                    row.cells[2].textContent = data.user.role;
                    alert("User role updated successfully");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to update role");
            }
        }
    };

    window.blockUser = async (userId) => {
        if (confirm("Are you sure you want to block this user?")) {
            try {
                const response = await fetch(`/users/${userId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });
                const data = await response.json();
                if (data.success) {
                    const row = document.querySelector(
                        `tr[data-user-id="${userId}"]`
                    );
                    row.remove();
                    alert("User blocked successfully");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to block user");
            }
        }
    };

    window.addUser = async () => {
        const name = prompt("Enter user name:");
        const email = prompt("Enter user email:");
        const password = prompt("Enter user password:");
        const role = prompt(
            "Enter user role (subscriber/editor/theme_manager):"
        );

        if (name && email && password && role) {
            try {
                const response = await fetch("/users", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ name, email, password, role }),
                });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to add user");
            }
        }
    };
});

document
    .getElementById("add-theme-form")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("/add-theme", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                "theme-title": formData.get("theme-title"),
                "theme-image": formData.get("theme-image"),
                "theme-manager": formData.get("theme-manager"),
                "theme-description": formData.get("theme-description"),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Theme added successfully!");
                    window.location.reload();
                } else {
                    alert("Failed to add theme. Please try again.");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            });
    });
async function addMagazine() {
    const number = document.getElementById("magazine-number").value;
    const title = document.getElementById("magazine-title").value;
    const isPublic = document.getElementById("magazine-status").value === "1";

    try {
        const response = await fetch("/magazines", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: JSON.stringify({ number, title, is_public: isPublic }),
        });

        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(
                `HTTP error! status: ${response.status}, body: ${errorText}`
            );
        }

        const data = await response.json();

        if (data.success) {
            alert("Magazine added successfully");
            addMagazineToTable(data.magazine);
            clearMagazineForm();
        } else {
            throw new Error(data.message || "Failed to add magazine");
        }
    } catch (error) {
        console.error("Error:", error);
        alert(error.message);
    }
}

function addMagazineToTable(magazine) {
    const tableBody = document.getElementById("magazines-table-body");
    const newRow = tableBody.insertRow();
    newRow.innerHTML = `
            <td>${magazine.number}</td>
            <td>${magazine.title}</td>
            <td>${magazine.is_public ? "Yes" : "No"}</td>
            <td>
                <a href="/magazines/${
                    magazine.id
                }" class="btn-primary">Manage</a>
                <button onclick="deleteMagazine(${
                    magazine.id
                })" class="btn-danger">Delete</button>
            </td>
        `;
}

function clearMagazineForm() {
    document.getElementById("magazine-number").value = "";
    document.getElementById("magazine-title").value = "";
    document.getElementById("magazine-status").value = "1";
}
// Update the deleteMagazine function to use the correct URL
window.deleteMagazine = async (id) => {
    if (!confirm("Are you sure you want to delete this magazine?")) {
        return;
    }

    try {
        const response = await fetch(`/magazine/${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) {
            throw new Error("Failed to delete magazine");
        }

        const data = await response.json();

        if (data.success) {
            const row = document.querySelector(`tr[data-magazine-id="${id}"]`);
            if (row) {
                row.remove();
            }
            alert("Magazine deleted successfully");
        } else {
            throw new Error(data.message || "Failed to delete magazine");
        }
    } catch (error) {
        console.error("Error:", error);
        alert(error.message);
    }
};
async function addMagazine() {
    const number = document.getElementById("magazine-number").value;
    const title = document.getElementById("magazine-title").value;
    const isPublic = document.getElementById("magazine-status").value === "1";

    try {
        const response = await fetch("/magazines", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: JSON.stringify({ number, title, is_public: isPublic }),
        });

        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(
                `HTTP error! status: ${response.status}, body: ${errorText}`
            );
        }

        const data = await response.json();

        if (data.success) {
            alert("Magazine added successfully");
            // Refresh the page instead of just adding to table
            window.location.reload();
        } else {
            throw new Error(data.message || "Failed to add magazine");
        }
    } catch (error) {
        console.error("Error:", error);
        alert(error.message);
    }
}

function addMagazineToTable(magazine) {
    const tableBody = document.getElementById("magazines-table-body");
    const newRow = tableBody.insertRow();
    newRow.innerHTML = `
          <td>${magazine.number}</td>
          <td>${magazine.title}</td>
          <td>${magazine.is_public ? "Yes" : "No"}</td>
          <td>
              <a href="/magazines/${
                  magazine.id
              }/manage" class="btn-primary">Manage</a>
              <form action="/magazines/${
                  magazine.id
              }" method="POST" style="display: inline;">
                  <input type="hidden" name="_token" value="${
                      document.querySelector('meta[name="csrf-token"]').content
                  }">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this magazine?')">Delete</button>
              </form>
          </td>
      `;
}

function clearMagazineForm() {
    document.getElementById("magazine-number").value = "";
    document.getElementById("magazine-title").value = "";
    document.getElementById("magazine-status").value = "1";
}

window.deleteMagazine = async (id) => {
    if (!confirm("Are you sure you want to delete this magazine?")) {
        return;
    }

    try {
        const response = await fetch(`/magazines/${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });

        if (!response.ok) {
            throw new Error("Failed to delete magazine");
        }

        const data = await response.json();

        if (data.success) {
            const row = document.querySelector(`tr[data-magazine-id="${id}"]`);
            if (row) {
                row.remove();
            }
            alert("Magazine deleted successfully");
        } else {
            throw new Error(data.message || "Failed to delete magazine");
        }
    } catch (error) {
        console.error("Error:", error);
        alert(error.message);
    }
};

window.rejectArticle = async (articleId) => {
    if (confirm("Are you sure you want to reject this article?")) {
        try {
            const response = await fetch(`/reject-article/${articleId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            });
            const data = await response.json();
            if (data.success) {
                alert("Article rejected successfully");
                location.reload();
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Failed to reject article");
        }
    }
};
