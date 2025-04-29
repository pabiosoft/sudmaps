## 🧱 Entity Overview — SudMaps Backend

### `Location`
> Represents a **geographic place** (e.g. neighborhood, village, zone)

**Fields:**
- `id` (UUID)
- `name`
- `description`
- `latitude`
- `longitude`
- `visibility`
- `isActif`

**Relations:**
- One-to-Many → `Landmark`
- One-to-Many → `Tag`
- One-to-Many → `SavedLocation`

---

### `Landmark`
> A **point of interest** attached to a Location (e.g. mosque, school, roundabout)

**Fields:**
- `id`
- `label`
- `location` (ManyToOne → `Location`)

---

### `Tag`
> A **keyword or label** used to classify a Location (e.g. "beach", "historic", "market")

**Fields:**
- `id`
- `name`
- `location` (ManyToOne → `Location`)

---

### `SavedLocation`
> Connects an **Owner** (user) with their favorite locations

**Fields:**
- `id`
- `owner` (ManyToOne → `Owner`)
- `location` (ManyToOne → `Location`)
- `savedAt`

---

### `Owner`
> Represents a **user** of the mobile application (formerly named `User`)

**Fields:**
- `id`
- `username`
- `email`
- `createdAt`

**Relations:**
- One-to-Many → `SavedLocation`

---

> ✅ All entities extend a `BaseEntity` that provides `id` and `isActif` by default.

/api/locations/1f020c52-45f9-637a-b6ad-25f9461f62b2
/api/users/1f020c52-45b5-6972-8e15-25f9461f62b2