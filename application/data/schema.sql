CREATE TABLE "video" (
    "id" integer PRIMARY KEY  NOT NULL,
    "url" varchar(255) NOT NULL,
    "youtube_id" varchar(20) NOT NULL,
    "title" varchar(200) NOT NULL,
    "published" integer DEFAULT 0,
    "created_at" datetime NOT NULL,
    "updated_at" datetime NOT NULL
);

CREATE TABLE "tagcategory" (
    "id" integer NOT NULL PRIMARY KEY,
    "category" varchar(64) NOT NULL
);

CREATE TABLE "tag" (
    "id" integer NOT NULL PRIMARY KEY,
    "video_id" integer NOT NULL REFERENCES "video" ("id"),
    "tag" varchar(64) NOT NULL,
    "tagcategory_id" integer NOT NULL REFERENCES "tagcategory" ("id"),
    "created_at" datetime NOT NULL,
    "updated_at" datetime NOT NULL
);
CREATE INDEX "tag_video_id" ON "tag" ("video_id");
CREATE INDEX "tag_tagcategory_id" ON "tag" ("tagcategory_id");