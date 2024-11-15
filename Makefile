.PHONY: help

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' makefiles/*.mk | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

include makefiles/*.mk