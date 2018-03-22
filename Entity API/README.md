Entity types in core come in two variants.

#Configuration Entity
Used by the Configuration System. Supports translations and can provide custom defaults for installations. Configuration entities are stored within the common config database table as rows.

#Content Entity
Consist of configurable and base fields, can have revisions and support translations. Content entities are stored within a custom database table as rows. The table name is the same as the content entity "id", and the columns are defined by the entity's "baseFieldDefinitions" method.