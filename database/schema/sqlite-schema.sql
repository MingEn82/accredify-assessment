CREATE TABLE IF NOT EXISTS "migration" ("id" integer primary key autoincrement not null);
CREATE TABLE IF NOT EXISTS "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);
CREATE TABLE IF NOT EXISTS "personal_access_tokens" ("id" integer primary key autoincrement not null, "tokenable_type" varchar not null, "tokenable_id" integer not null, "name" varchar not null, "token" varchar not null, "abilities" text, "last_used_at" datetime, "expires_at" datetime, "created_at" datetime, "updated_at" datetime);
CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" on "personal_access_tokens" ("tokenable_type", "tokenable_id");
CREATE UNIQUE INDEX "personal_access_tokens_token_unique" on "personal_access_tokens" ("token");
CREATE TABLE IF NOT EXISTS "results" ("id" integer primary key autoincrement not null, "user_id" varchar, "file_type" varchar not null, "verification_result" varchar not null, "created_at" datetime, "updated_at" datetime);
INSERT INTO migrations VALUES(1,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO migrations VALUES(2,'2023_07_31_103455_create_results_table',1);
